<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail; // Jangan lupa import ini
use App\Services\GoDaddyApi;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input Baru
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'], // Wajib isi
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms_agreed' => ['required', 'accepted'],
        ]);

        Session::forget('registration_data');
        Session::forget('registration_otp');

        $otp = random_int(100000, 999999);
        
        // 2. SIMPAN DATA TERPISAH KE SESSION (PENTING!)
        $tempData = [
            'username'   => $request->username,
            'first_name' => $request->first_name, // Simpan Nama Depan
            'last_name'  => $request->last_name,  // Simpan Nama Belakang
            'name'       => $request->first_name . ' ' . $request->last_name, // Gabungan untuk display
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(5)
        ];

        Session::put('registration_data', $tempData);

        try {
            Mail::to($request->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['email' => 'Gagal kirim email OTP.']);
        }

        return redirect()->route('otp.verify');
    }
}