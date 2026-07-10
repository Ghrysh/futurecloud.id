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
        $request->validate([
            'payment_method' => 'required|string',
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'exists:carts,id',
            'total_amount' => 'required|numeric'
        ]);

        try {
            $subtotal = $request->total_amount;
            $ppn = $subtotal * 0.11;
            $grand_total = $subtotal + $ppn;

            $order = DB::transaction(function () use ($request, $grand_total) {
                $cartItems = Cart::whereIn('id', $request->cart_ids)
                                 ->where('user_id', Auth::id())
                                 ->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Keranjang belanja kosong atau item tidak valid.');
                }

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

            $va = env('IPAYMU_VA');
            $secret = env('IPAYMU_API_KEY');
            $env = env('IPAYMU_ENV', 'sandbox');
            $url = $env == 'production' ? 'https://my.ipaymu.com/api/v2/payment' : 'https://sandbox.ipaymu.com/api/v2/payment';

            $body = [
                'account'       => $va,
                'product'       => ['Tagihan ' . $order->invoice_number, 'PPN 11%'],
                'qty'           => ['1', '1'],
                'price'         => [$subtotal, $ppn],
                'returnUrl'     => route('order.instruction', ['id' => $order->id]),
                'notifyUrl'     => route('ipaymu.callback'),
                'cancelUrl'     => route('cart.index'),
                'referenceId'   => $order->invoice_number,
                'buyerName'     => Auth::user()->name,
                'buyerEmail'    => Auth::user()->email,
            ];

            $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
            $requestBody = strtolower(hash('sha256', $jsonBody));
            $stringToSign = strtoupper('POST') . ':' . $va . ':' . $requestBody . ':' . $secret;
            $signature = hash_hmac('sha256', $stringToSign, $secret);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'signature'    => $signature,
                'va'           => $va,
                'timestamp'    => date('YmdHis')
            ])->post($url, $body);

            $result = $response->json();

            if ($response->successful() && $result['Status'] == 200) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mengarahkan ke pembayaran...',
                    'redirect_instruction' => $result['Data']['Url'], 
                ]);
            } else {
                throw new \Exception($result['Message'] ?? 'Gagal membuat sesi pembayaran.');
            }

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

                $namecheap = new NamecheapService();

                foreach ($order->items as $item) {
                    if ($item->type === 'domain') {
                        $config = json_decode($item->configuration, true);
                        $domainName = $config['domain_name'] ?? $item->product_name;

                        $contactData = [
                            'first_name' => $order->user->name,
                            'last_name' => 'Customer',
                            'email' => $order->user->email,
                            'phone' => '+62.80000000000',
                        ];

                        try {
                            $namecheap->registerDomain($domainName, 1, $contactData);
                            Log::info("Domain {$domainName} berhasil didaftarkan via Namecheap untuk Order {$invoice}.");
                        } catch (\Exception $e) {
                            Log::error("Gagal mendaftarkan domain {$domainName} di Namecheap: " . $e->getMessage());
                        }
                    }
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
