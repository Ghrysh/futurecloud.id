<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function index()
    {
        return view('Dashboard.migration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'old_domain' => 'required',
            'old_username' => 'required',
            'old_password' => 'required',
            'old_provider' => 'required', // Misal: Exabytes
        ]);

        // DI SINI SIMPAN KE DATABASE (Tabel Tickets atau Migrations)
        // Untuk demo, kita pakai Notifikasi saja
        
        return back()->with('success', 'Permintaan migrasi dikirim! Tim teknis kami akan segera memindahkan data Anda.');
    }
}