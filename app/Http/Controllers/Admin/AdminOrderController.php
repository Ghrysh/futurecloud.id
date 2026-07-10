<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\NamecheapService; // Import Service Namecheap
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    // 1. Menampilkan Daftar Pesanan
    public function index(Request $request)
    {
        \App\Models\Order::cleanUpExpired();
        
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // 2. Menampilkan Detail Pesanan
    public function show($id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // 3. Update Status Order & Otomatisasi API Namecheap
    public function updateStatus(Request $request, $id, NamecheapService $namecheap)
    {
        // Load order beserta user dan items untuk keperluan API
        $order = Order::with(['items', 'user'])->findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        // CEK: Apakah status berubah menjadi PAID?
        // Jika ya, jalankan otomatisasi pembelian domain
        if ($request->status == 'paid' && $order->status != 'paid') {
            
            // Panggil fungsi provisioning tersentralisasi
            try {
                \App\Http\Controllers\OrderController::provisionOrder($order);
            } catch (\Exception $e) {
                Log::error("Gagal melakukan provisioning pesanan {$order->id}: " . $e->getMessage());
                session()->flash('error', "Status diubah ke Paid, tapi ada error saat provisioning (lihat log).");
            }

            // Set waktu pembayaran
            $order->paid_at = now();
        }

        // Simpan status baru ke database lokal
        $order->status = $request->status;
        $order->save();

        // Jika tadi ada error API, return back dengan error flash, jika tidak success flash
        if (session()->has('error')) {
            return back(); 
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // 4. Update Konfigurasi Item (IP Address, Username, Password)
    public function updateItemConfig(Request $request, $id)
    {
        $item = OrderItem::findOrFail($id);

        $request->validate([
            'ip_address' => 'nullable|string',
            'username'   => 'nullable|string',
            'password'   => 'nullable|string',
        ]);

        $currentConfig = $item->configuration ?? [];

        if ($request->filled('ip_address')) {
            $currentConfig['ip_address'] = $request->input('ip_address');
        }
        if ($request->filled('username')) {
            $currentConfig['username'] = $request->input('username');
        }
        if ($request->filled('password')) {
            $currentConfig['password'] = $request->input('password'); 
        }

        $item->configuration = $currentConfig;
        $item->save();

        return back()->with('success', 'Konfigurasi teknis berhasil diperbarui. Data akan tampil di Client Area user.');
    }

    // 5. Hapus Order
    public function destroy($id)
    {
        // Hapus Order (Item akan terhapus otomatis karena cascade on delete di migration)
        Order::destroy($id);
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan dihapus permanen.');
    }
}