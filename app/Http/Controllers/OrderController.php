<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\NamecheapService;

class OrderController extends Controller
{
public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'payment_method' => 'required|string',
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'exists:carts,id',
            'total_amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('cart_ids') || $validator->errors()->has('cart_ids.0')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pesanan Anda sudah dibuat. Silakan cek tagihan Anda di Client Area.',
                    'redirect_instruction' => route('client.invoices')
                ]);
            }
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $cartItems = Cart::whereIn('id', $request->cart_ids)
                             ->where('user_id', Auth::id())
                             ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang belanja kosong atau item tidak valid.');
            }

            $subtotal = $cartItems->sum('price');
            $ppn = $subtotal * 0.11;
            $grand_total = $subtotal + $ppn;

            $order = DB::transaction(function () use ($request, $grand_total, $cartItems) {


                $order = Order::create([
                    'user_id' => Auth::id(),
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                    'total_amount' => $grand_total,
                    'payment_method' => $request->payment_method,
                    'status' => 'pending', 
                ]);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_name' => $item->product_name,
                        'type' => $item->type,
                        'price' => $item->price,
                        'billing_cycle' => $item->billing_cycle,
                        'configuration' => $item->configuration, 
                    ]);
                }

                Cart::whereIn('id', $request->cart_ids)->delete();

                return $order;
            });

            // Langsung arahkan ke instruksi pembayaran manual
            return response()->json([
                'status' => 'success',
                'message' => 'Mengarahkan ke pembayaran...',
                'redirect_instruction' => route('order.instruction', ['id' => $order->id]), 
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ipaymuCallback(Request $request)
    {
        $status = $request->status;
        $trx_id = $request->trx_id;
        $invoice = $request->reference_id;

        Log::info("iPaymu Webhook received for {$invoice} with status: {$status}");

        if ($status == 'berhasil' || $status == 'sukses') {
            $order = Order::with('items', 'user')->where('invoice_number', $invoice)->first();

            if ($order && $order->status !== 'paid') {
                $order->update(['status' => 'paid']);
                $this->provisionOrder($order);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    public static function provisionOrder($order)
    {
        $namecheap = new NamecheapService();
        foreach ($order->items as $item) {
            // Cek jika produk adalah plugin (dari nama produk)
            $isPlugin = str_contains(strtolower($item->product_name), 'plugin');
            $config = json_decode($item->configuration, true) ?? [];

            // --- HANDLE DOMAIN ---
            if ($item->type === 'domain') {
                $domainName = $config['domain_name'] ?? $item->product_name;

                $contactData = [
                    'first_name' => $order->user->name,
                    'last_name' => 'Customer',
                    'email' => $order->user->email,
                    'phone' => '+62.80000000000',
                ];

                try {
                    $namecheap->registerDomain($domainName, 1, $contactData);
                    Log::info("Domain {$domainName} berhasil didaftarkan via Namecheap untuk Order {$order->invoice_number}.");
                } catch (\Exception $e) {
                    Log::error("Gagal mendaftarkan domain {$domainName} di Namecheap: " . $e->getMessage());
                }
            } 
            // --- HANDLE PLUGIN LISENSI ---
            elseif ($isPlugin) {
                // Tentukan expired_at berdasarkan billing_cycle
                $expiredAt = null;
                if ($item->billing_cycle === 'monthly') {
                    $expiredAt = now()->addMonth()->format('Y-m-d H:i:s');
                } elseif ($item->billing_cycle === 'annually') {
                    $expiredAt = now()->addYear()->format('Y-m-d H:i:s');
                }

                // Generate License Key
                $licenseKey = 'FC-LIC-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '-' . strtoupper(\Illuminate\Support\Str::random(6));
                $config['license_key'] = $licenseKey;
                $config['expired_at'] = $expiredAt;
                
                $item->configuration = json_encode($config);
                $item->save();

                // Tentukan URL API berdasarkan nama plugin
                $isChatbot = str_contains(strtolower($item->product_name), 'chatbot');
                // Fallback default: Chatbot -> 8081, Monitoring -> 8082
                $syncUrl = $isChatbot 
                    ? env('CHATBOT_API_URL', 'http://localhost:8081') . '/api/v1/license/sync'
                    : env('MONITORING_API_URL', 'http://localhost:8082') . '/api/v1/license/sync';

                try {
                    \Illuminate\Support\Facades\Http::post($syncUrl, [
                        'name' => $order->user->name,
                        'email' => $order->user->email,
                        'license_key' => $licenseKey,
                        'expired_at' => $expiredAt,
                    ]);
                    Log::info("Lisensi {$licenseKey} untuk plugin {$item->product_name} berhasil di-sync ke {$syncUrl}");
                    
                    // Simpan status active secara lokal
                    $config['status'] = 'active';
                    $item->configuration = json_encode($config);
                    $item->save();
                    
                } catch (\Exception $e) {
                    Log::error("Gagal sinkronisasi lisensi {$licenseKey} ke {$syncUrl}: " . $e->getMessage());
                }
            }
        }
    }


    public function instruction($id)
    {
        Order::cleanUpExpired();
        
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$order) {
            return redirect()->route('client.invoices')->with('error', 'Pesanan tidak ditemukan atau sudah kedaluwarsa.');
        }
        return view('order.instruction', compact('order'));
    }

    public function uploadProof(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png|max:5120'
        ], [
            'payment_proof.required' => 'File bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'File harus berupa gambar.',
            'payment_proof.mimes' => 'Format gambar harus JPG atau PNG.',
            'payment_proof.max' => 'Ukuran gambar maksimal adalah 5 MB.',
        ]);

        if ($request->hasFile('payment_proof')) {
            // Hapus bukti lama jika ada
            if ($order->payment_proof && \Illuminate\Support\Facades\Storage::disk('public')->exists($order->payment_proof)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($order->payment_proof);
            }

            $path = $request->file('payment_proof')->store('proofs', 'public');
            $order->update(['payment_proof' => $path]);
            
            // Kirim notifikasi email ke Admin
            try {
                $messageText = "Halo Admin,\n\nPelanggan {$order->user->name} telah mengunggah bukti pembayaran untuk pesanan {$order->invoice_number}.\n\nSilakan cek dan verifikasi di panel admin:\n" . route('admin.orders.show', $order->id);
                
                \Illuminate\Support\Facades\Mail::raw($messageText, function ($message) use ($order) {
                    $message->to('ptbtt01@gmail.com')
                            ->subject('Konfirmasi Pembayaran: ' . $order->invoice_number);
                });
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email konfirmasi pembayaran: ' . $e->getMessage());
            }
        }

        return redirect()->route('client.invoices')->with('success', 'Bukti pembayaran berhasil diunggah! Admin akan segera memverifikasinya.');
    }

    public function pluginInstalledWebhook(Request $request)
    {
        $licenseKey = $request->license_key;
        if (!$licenseKey) return response()->json(['status' => 'error'], 400);
        
        // Cari order item yang punya config json dengan license_key ini
        $items = \App\Models\OrderItem::where('product_name', 'like', '%Plugin%')->get();
        foreach ($items as $item) {
            $config = $item->configuration ?? [];
            if(is_string($config)) $config = json_decode($config, true) ?? [];
            if (isset($config['license_key']) && $config['license_key'] === $licenseKey) {
                $config['is_installed'] = true;
                $item->configuration = json_encode($config);
                $item->save();
                return response()->json(['status' => 'success', 'message' => 'Plugin marked as installed']);
            }
        }
        return response()->json(['status' => 'not_found'], 404);
    }
}