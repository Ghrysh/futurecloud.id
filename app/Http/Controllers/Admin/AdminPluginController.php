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
                try {
                    $pluginData = \Illuminate\Support\Facades\DB::connection('plugin_db')
                        ->table('clients')
                        ->where('license_key', $licenseKey)
                        ->first();
                    $item->plugin_status = $pluginData ? $pluginData->status : 'unknown';
                } catch (\Exception $e) {
                    $item->plugin_status = 'error';
                }
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
            try {
                $client = \Illuminate\Support\Facades\DB::connection('plugin_db')
                    ->table('clients')
                    ->where('license_key', $licenseKey)
                    ->first();
                
                if ($client) {
                    $newStatus = $client->status === 'active' ? 'inactive' : 'active';
                    \Illuminate\Support\Facades\DB::connection('plugin_db')
                        ->table('clients')
                        ->where('license_key', $licenseKey)
                        ->update(['status' => $newStatus]);
                    
                    return back()->with('success', 'Status lisensi plugin pelanggan berhasil diubah menjadi ' . $newStatus . '.');
                }
                return back()->with('error', 'Data pelanggan tidak ditemukan di Plugin API.');
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
            }
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
            try {
                \Illuminate\Support\Facades\DB::connection('plugin_db')
                    ->table('clients')
                    ->where('license_key', $licenseKey)
                    ->delete();
            } catch (\Exception $e) {
                // Ignore error if connection fails, still delete the local order item
            }
        }
        
        $item->delete();
        
        return back()->with('success', 'Data pelanggan dan lisensi plugin berhasil dihapus permanen.');
    }
}
