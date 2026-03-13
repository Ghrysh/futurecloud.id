<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login menggunakan Guard 'admin'
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    // Logout Admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}