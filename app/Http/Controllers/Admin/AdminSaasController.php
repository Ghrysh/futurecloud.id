<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaasProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSaasController extends Controller
{
    // 1. LIST APLIKASI
    public function saasIndex()
    {
        $apps = SaasProduct::with('user')
            ->where('category', '!=', 'Plugin')
            ->orWhereNull('category')
            ->latest()
            ->get();
        return view('admin.saas.index', compact('apps'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.saas.create-edit');
    }

    // 3. SIMPAN APLIKASI BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:saas_products,slug',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'plans' => 'nullable|array', // JSON Plans
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id() ?? Auth::id() ?? 1; 
        $data['status'] = 'approved'; // Admin auto approve
        
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('saas', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        } else {
            $data['thumbnail'] = 'assets/img/placeholder.jpg'; // Default dulu
        }
        
        $data['features'] = $data['features'] ?? []; // Fix SQL error

        SaasProduct::create($data);

        return redirect()->route('admin.saas.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $saas = SaasProduct::findOrFail($id);
        return view('admin.saas.create-edit', compact('saas'));
    }

    // 5. UPDATE APLIKASI
    public function update(Request $request, $id)
    {
        $app = SaasProduct::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:saas_products,slug,'.$id,
            'price' => 'required|numeric',
        ]);
        
        $data = $request->all();
        if (!isset($data['features'])) {
            $data['features'] = [];
        }
        
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('saas', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        $app->update($data);

        return redirect()->route('admin.saas.index')->with('success', 'Aplikasi berhasil diperbarui.');
    }

    // 6. DELETE APLIKASI
    public function destroy($id)
    {
        SaasProduct::destroy($id);
        return back()->with('success', 'Aplikasi dihapus.');
    }

    // ... (Method Approve/Reject/Show tetap ada seperti sebelumnya) ...
    public function saasShow($id) {
        $app = SaasProduct::with('user')->findOrFail($id);
        return view('admin.saas.show', compact('app'));
    }
    
    public function approveSaas($id) {
        $app = SaasProduct::findOrFail($id);
        $app->status = 'approved';
        $app->save();
        return back()->with('success', 'Aplikasi disetujui dan live.');
    }

    public function rejectSaas(Request $request, $id) {
        $app = SaasProduct::findOrFail($id);
        $app->status = 'rejected';
        $app->save();
        return back()->with('success', 'Aplikasi ditolak.');
    }
}