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
            
        return view('admin.plugin.customers', compact('customers'));
    }
}
