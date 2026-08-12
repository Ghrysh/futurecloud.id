<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('helpdesk')->check()) {
            return redirect()->route('helpdesk.dashboard');
        }
        return view('helpdesk.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Juga cek apakah akun aktif
        $user = \App\Models\HelpdeskUser::where('email', $credentials['email'])
            ->where('is_active', true)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan atau dinonaktifkan.'])->withInput();
        }

        if (Auth::guard('helpdesk')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Update last login
            $user->update(['last_login_at' => now()]);

            return redirect()->route('helpdesk.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('helpdesk')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('helpdesk.login');
    }
}
