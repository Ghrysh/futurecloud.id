<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaasProduct;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnerSaasController extends Controller
{
    public function create()
    {
        return view('partner.register-saas');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            // Cek 'unique:saas_products,name' agar nama tidak boleh kembar
            'name' => 'required|string|max:255|unique:saas_products,name', 
            'category' => 'required|string',
            'price' => 'required|numeric',
            'tagline' => 'required|string|max:150',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ], [
            // Pesan Error Custom (Bahasa Indonesia)
            'name.unique' => 'Nama aplikasi ini sudah terdaftar. Mohon gunakan nama lain.',
            'thumbnail.max' => 'Ukuran gambar terlalu besar (Maksimal 2MB).',
            'thumbnail.image' => 'File harus berupa gambar (JPG/PNG).',
        ]);

        try {
            // 2. UPLOAD GAMBAR
            $imagePath = null;
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('saas-thumbnails', 'public');
            }

            // 3. SIMPAN KE DATABASE
            SaasProduct::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category' => $request->category,
                'tagline' => $request->tagline,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $imagePath,
                'status' => 'pending', // Wajib Pending agar Admin cek dulu
            ]);

            // 4. REDIRECT KE HALAMAN SUKSES
            return redirect()->route('partner.saas.success');

        } catch (\Exception $e) {
            // Jika ada error sistem lain (misal gagal upload)
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('partner.success');
    }
}