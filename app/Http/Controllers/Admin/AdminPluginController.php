<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaasProduct;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPluginController extends Controller
{
    // 1. LIST PLUGIN
    public function index()
    {
        $apps = SaasProduct::with('user')
            ->where('category', 'Plugin')
            ->latest()
            ->get();
        return view('admin.plugin.index', compact('apps'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.plugin.create-edit');
    }

    // 3. SIMPAN PLUGIN BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:saas_products,slug',
            'price' => 'required|numeric',
            'description' => 'required',
            'plans' => 'nullable|array', // JSON Plans
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id() ?? Auth::id() ?? 1; 
        $data['category'] = 'Plugin';
        $data['status'] = 'approved'; // Admin auto approve
        
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('plugins', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        } else {
            $data['thumbnail'] = 'assets/img/placeholder.jpg'; // Default dulu
        }

        // Simpan cycle di array plans
        $data['plans'] = [
            'cycle' => $request->cycle ?? 'lifetime',
        ];

        SaasProduct::create($data);

        return redirect()->route('admin.plugin.index')->with('success', 'Plugin berhasil ditambahkan.');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $plugin = SaasProduct::findOrFail($id);
        return view('admin.plugin.create-edit', compact('plugin'));
    }

    // 5. UPDATE PLUGIN
    public function update(Request $request, $id)
    {
        $app = SaasProduct::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:saas_products,slug,'.$id,
            'price' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['category'] = 'Plugin';

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('plugins', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        // Simpan cycle di array plans
        $data['plans'] = [
            'cycle' => $request->cycle ?? 'lifetime',
        ];

        $app->update($data);

        return redirect()->route('admin.plugin.index')->with('success', 'Plugin berhasil diperbarui.');
    }

    // 6. DELETE PLUGIN
    public function destroy($id)
    {
        SaasProduct::destroy($id);
        return back()->with('success', 'Plugin dihapus.');
    }

    // 7. LIST PELANGGAN PLUGIN
    public function customers()
    {
        // Ambil semua order_item dengan type 'saas' dan product_name mengandung 'Plugin' yang order-nya berstatus 'paid'
        $customers = OrderItem::with(['order.user'])
            ->where('type', 'saas')
            ->whereHas('order', function($q) {
                $q->where('status', 'paid');
            })
            ->where('product_name', 'LIKE', '%Plugin%')
            ->latest()
            ->get();

        foreach ($customers as $item) {
            $config = $item->configuration ?? [];
            if (is_string($config)) {
                $config = json_decode($config, true) ?? [];
            }
            $licenseKey = $config['license_key'] ?? null;
            if ($licenseKey) {
                // Gunakan status dari local config, default active untuk transisi
                $item->plugin_status = $config['status'] ?? 'active';
            } else {
                $item->plugin_status = 'no_license';
            }
        }
            
        return view('admin.plugin.customers', compact('customers'));
    }

    // 8. TOGGLE CUSTOMER STATUS
    public function toggleCustomerStatus($id)
    {
        $item = OrderItem::findOrFail($id);
        
        $config = $item->configuration ?? [];
        if (is_string($config)) {
            $config = json_decode($config, true) ?? [];
        }
        $licenseKey = $config['license_key'] ?? null;

        if ($licenseKey) {
            $currentStatus = $config['status'] ?? 'active';
            $newStatus = $currentStatus === 'active' ? 'inactive' : 'active';
            
            // Tentukan URL API
            $isChatbot = str_contains(strtolower($item->product_name), 'chatbot');
            $apiUrl = $isChatbot 
                ? env('CHATBOT_API_URL', 'http://localhost:8081') 
                : env('MONITORING_API_URL', 'http://localhost:8082');

            try {
                \Illuminate\Support\Facades\Http::post($apiUrl . '/api/v1/license/status', [
                    'license_key' => $licenseKey,
                    'status' => $newStatus
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Gagal sinkronisasi toggle status lisensi {$licenseKey}: " . $e->getMessage());
                // Tetap lanjut ubah lokal agar UI responsif meski API offline
            }
            
            // Simpan perubahan ke local
            $config['status'] = $newStatus;
            $item->configuration = json_encode($config);
            $item->save();
            
            return back()->with('success', 'Status lisensi plugin pelanggan berhasil diubah menjadi ' . $newStatus . '.');
        }
        
        return back()->with('error', 'Lisensi tidak valid.');
    }

    // 9. DELETE CUSTOMER
    public function destroyCustomer($id)
    {
        $item = OrderItem::findOrFail($id);
        
        $config = $item->configuration ?? [];
        if (is_string($config)) {
            $config = json_decode($config, true) ?? [];
        }
        $licenseKey = $config['license_key'] ?? null;

        if ($licenseKey) {
            // Tentukan URL API
            $isChatbot = str_contains(strtolower($item->product_name), 'chatbot');
            $apiUrl = $isChatbot 
                ? env('CHATBOT_API_URL', 'http://localhost:8081') 
                : env('MONITORING_API_URL', 'http://localhost:8082');

            try {
                \Illuminate\Support\Facades\Http::delete($apiUrl . '/api/v1/license/' . $licenseKey);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Gagal sinkronisasi hapus lisensi {$licenseKey}: " . $e->getMessage());
            }
        }
        
        $item->delete();
        
        return back()->with('success', 'Data pelanggan dan lisensi plugin berhasil dihapus permanen.');
    }
}
