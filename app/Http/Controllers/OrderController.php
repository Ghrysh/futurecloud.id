<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'payment_method' => 'required|string',
            'cart_ids' => 'required|array', // Pastikan array ID cart ada
            'cart_ids.*' => 'exists:carts,id',
            'total_amount' => 'required|numeric'
        ]);

        try {
            // Gunakan Transaction agar data aman
            // Kita tampung hasilnya ke variabel $orderId
            $orderId = DB::transaction(function () use ($request) {
                
                // A. Ambil Item dari Cart yang dipilih
                $cartItems = Cart::whereIn('id', $request->cart_ids)
                                 ->where('user_id', Auth::id())
                                 ->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Keranjang belanja kosong atau item tidak valid.');
                }

                // B. Buat Order Utama
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                    'total_amount' => $request->total_amount,
                    'payment_method' => $request->payment_method,
                    'status' => 'pending', // Default pending
                ]);

                // C. Pindahkan Item Cart ke Order Items
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

                // D. Hapus Item dari Cart
                Cart::whereIn('id', $request->cart_ids)->delete();

                // E. PENTING: Return ID Order agar bisa ditangkap variabel $orderId
                return $order->id;
            });

            // 3. Return JSON Response dengan URL Redirect yang Benar
            // Pastikan route 'order.instruction' ada di web.php
            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat!',
                'redirect_instruction' => route('order.instruction', ['id' => $orderId]),
            ]);

        } catch (\Exception $e) {
            // Jika error, return status error
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Menampilkan Halaman Instruksi Pembayaran
    public function instruction($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        // Jika status sudah paid, lempar ke dashboard
        if ($order->status == 'paid') {
            return redirect()->route('client.dashboard');
        }

        return view('order.instruction', compact('order'));
    }

    // Halaman Sukses (Opsional / Dipakai Callback)
    public function success($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items')->findOrFail($id);
        return view('order.success', compact('order'));
    }
}