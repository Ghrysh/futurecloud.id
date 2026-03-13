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
            
            foreach ($order->items as $item) {
                // Ambil konfigurasi item (JSON)
                $config = $item->configuration ?? [];

                // --- A. OTOMATISASI DOMAIN ---
                if ($item->type == 'domain') {
                    // Tentukan nama domain dan durasi tahun
                    // Cek key 'domain_connection' (dari form hosting) atau 'domain' (dari form domain) atau nama produk
                    $domainName = $config['domain_connection'] ?? ($config['domain'] ?? $item->product_name);
                    
                    // Bersihkan nama domain dari kata-kata tambahan jika ada (misal: "Domain premium (example.com)")
                    // Jika user input bersih, logic ini aman. Jika tidak, regex ini membantu mengambil domain.
                    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domainName, $matches)) {
                        $domainName = $matches['domain'];
                    }

                    $years = $config['years'] ?? 1;

                    try {
                        // 1. Siapkan Data Kontak dari Profil User
                        // Namecheap butuh nama depan dan belakang terpisah
                        $nameParts = explode(' ', $order->user->name, 2);
                        $firstName = $nameParts[0];
                        $lastName  = $nameParts[1] ?? 'Customer'; // Fallback jika tidak ada nama belakang

                        $contactData = [
                            'first_name' => $firstName,
                            'last_name'  => $lastName,
                            'email'      => $order->user->email,
                            'phone'      => $order->user->phone ?? '+62.81234567890', // Format wajib +NN.NNNN
                            'address'    => $order->user->address ?? 'Jl. Raya Indonesia No 1',
                            'city'       => 'Jakarta',
                            'state'      => 'DKI Jakarta',
                            'zip'        => '10110',
                            'country'    => 'ID'
                        ];

                        // 2. Panggil API Namecheap
                        // Pastikan saldo di Namecheap cukup!
                        $result = $namecheap->registerDomain($domainName, $years, $contactData);

                        // Log Sukses
                        Log::info("AUTO-REGISTER SUCCESS: Domain $domainName berhasil didaftarkan. Order ID Namecheap: " . $result['order_id']);
                        
                        // Opsional: Simpan Order ID Namecheap ke notes item
                        $config['notes'] = "Registered via API. NC OrderID: " . $result['order_id'];
                        $item->configuration = $config;
                        $item->save();

                    } catch (\Exception $e) {
                        // Jika Gagal (Misal saldo kurang atau koneksi timeout), catat error tapi JANGAN batalkan status Paid di lokal
                        // Admin harus cek log dan proses manual jika error.
                        Log::error("AUTO-REGISTER FAILED: Gagal mendaftarkan $domainName. Error: " . $e->getMessage());
                        
                        // Flash message warning ke Admin
                        session()->flash('error', "Status diubah ke Paid, NAMUN gagal register domain $domainName di Namecheap: " . $e->getMessage());
                    }
                }

                // --- B. OTOMATISASI LAINNYA (VPS/HOSTING) ---
                // Untuk VPS/Hosting biasanya provisioning butuh waktu atau pakai modul WHM/cPanel terpisah.
                // Disini kita skip dulu, admin input IP manual nanti.
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