<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaasProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerDashboardController extends Controller
{
    // 1. DASHBOARD UTAMA PARTNER
    public function index()
    {
        $myApps = SaasProduct::where('user_id', Auth::id())->latest()->get();
        
        // Statistik Sederhana
        $totalApps = $myApps->count();
        $activeApps = $myApps->where('status', 'approved')->count();
        $pendingApps = $myApps->where('status', 'pending')->count();

        return view('partner.dashboard.index', compact('myApps', 'totalApps', 'activeApps', 'pendingApps'));
    }

    // 2. [BARU] HALAMAN KELOLA APLIKASI (LIST)
    public function appsIndex()
    {
        $myApps = SaasProduct::where('user_id', Auth::id())->latest()->get();
        return view('partner.dashboard.my-apps', compact('myApps'));
    }

    // 2. HALAMAN EDIT APLIKASI
    public function edit($id)
    {
        $app = SaasProduct::where('user_id', Auth::id())->findOrFail($id);
        return view('partner.dashboard.edit-app', compact('app'));
    }

    public function update(Request $request, $id)
    {
        $app = SaasProduct::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'tagline' => 'required|string|max:150',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable artinya boleh kosong jika tidak ganti gambar
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Update slug jika nama berubah
            'category' => $request->category,
            'price' => $request->price,
            'tagline' => $request->tagline,
            'description' => $request->description,
        ];

        // Cek apakah user mengupload gambar baru
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada (dan bukan dari assets dummy)
            if ($app->thumbnail && Storage::disk('public')->exists($app->thumbnail)) {
                Storage::disk('public')->delete($app->thumbnail);
            }
            // Simpan gambar baru
            $data['thumbnail'] = $request->file('thumbnail')->store('saas-thumbnails', 'public');
        }

        // Opsional: Kembalikan status ke 'pending' jika diedit agar admin cek ulang
        // $data['status'] = 'pending'; 

        $app->update($data);

        return redirect()->route('partner.apps.index')->with('success', 'Aplikasi berhasil diperbarui!');
    }

    // 4. HAPUS APLIKASI
    public function destroy($id)
    {
        $app = SaasProduct::where('user_id', Auth::id())->findOrFail($id);
        if ($app->thumbnail) {
            Storage::disk('public')->delete($app->thumbnail);
        }
        $app->delete();
        
        return back()->with('success', 'Aplikasi dihapus.');
    }
    
    // 1. PROSES PENDAFTARAN (Diubah jadi Pending)
    public function joinStore(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $user->update([
            'company_name' => $request->company_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => 'user', // Tetap user biasa dulu
            'partner_status' => 'pending', // Status menunggu admin
        ]);

        // Arahkan ke halaman informasi pending
        return redirect()->route('partner.pending');
    }

    // 2. HALAMAN MENUNGGU (PENDING PAGE)
    public function pending()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Jika sudah approved, lempar ke dashboard
        if ($user->partner_status === 'approved') {
            return redirect()->route('partner.dashboard');
        }

        return view('partner.pending');
    }

    // ----------------------------------------------------
    // FITUR 2: PROFIL PERUSAHAAN
    // ----------------------------------------------------

    public function companyProfile()
    {
        $user = Auth::user();
        return view('partner.dashboard.profile-company', compact('user'));
    }

    public function updateCompanyProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            'company_name' => $request->company_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}