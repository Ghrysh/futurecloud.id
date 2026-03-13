<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Services\GoDaddyApi; 
use Illuminate\Support\Facades\Log;

class OtpVerificationController extends Controller
{
    /**
     * Tampilkan halaman input OTP
     */
    public function show(Request $request): View|RedirectResponse
    {
        // Cek apakah ada data pendaftaran di session
        if (!Session::has('registration_data')) {
            return redirect()->route('register')->with('error', 'Sesi pendaftaran berakhir. Silakan daftar ulang.');
        }
        
        $email = Session::get('registration_data')['email'];

        return view('auth.otp-verify', compact('email'));
    }

    /**
     * Proses Verifikasi OTP & Finalisasi Pendaftaran
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([ 'otp_code' => ['required', 'digits:6'] ]);

        $sessionData = Session::get('registration_data');

        // Validasi Session & OTP (Code standar...)
        if (!$sessionData) return redirect()->route('register');
        if (strval($request->otp_code) !== strval($sessionData['otp'])) return back()->withErrors(['otp_code' => 'Salah.']);

        // --- 1. BUAT USER (Dengan Kolom Baru) ---
        $user = User::create([
            'username'   => $sessionData['username'],   // Ambil dari session
            'first_name' => $sessionData['first_name'], // Ambil dari session
            'last_name'  => $sessionData['last_name'],  // Ambil dari session
            'name'       => $sessionData['name'],
            'email'      => $sessionData['email'],
            'password'   => $sessionData['password'],
            'email_verified_at' => now(),
        ]);

        // --- 2. INTEGRASI GODADDY ---
        try {
            $goDaddy = new GoDaddyApi();

            // Panggil API dengan data yang sudah bersih dari form
            $shopperId = $goDaddy->createShopper([
                'id'         => $user->id,
                'email'      => $user->email,
                'name_first' => $user->first_name, // Pakai kolom database/session
                'name_last'  => $user->last_name,  // Pakai kolom database/session
            ]);

            if ($shopperId) {
                $user->update(['godaddy_shopper_id' => $shopperId]);
            }

        } catch (\Exception $e) {
            // 1. HAPUS dd() YANG MEMBUAT LAYAR PUTIH
            // dd("STOP! GoDaddy Error:", $e->getMessage()); 
            
            // 2. CATAT ERROR DI LOG (Agar Anda tahu kapan API sudah benar-benar aktif nanti)
            Log::warning("GoDaddy API Warning: " . $e->getMessage());

            // 3. MODE BYPASS (PENYELAMAT)
            // Karena API menolak (NOT_A_RESELLER), kita buat Shopper ID Palsu dulu
            // Agar user TETAP BISA LOGIN dan masuk Dashboard.
            // Nanti kalau API sudah fix (1-2 hari lagi), user baru akan otomatis dapat ID asli.
            
            $dummyShopperId = 'PENDING-' . rand(100000, 999999);
            $user->update(['godaddy_shopper_id' => $dummyShopperId]);
        }

        // --- 3. LOGIN ---
        event(new Registered($user));
        Session::forget('registration_data');
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    /**
     * Kirim Ulang OTP (Resend)
     */
    public function resend(Request $request): RedirectResponse
    {
        if (!Session::has('registration_data')) {
             return redirect()->route('register')
                ->with('error', 'Sesi pendaftaran telah berakhir. Silakan daftar ulang.');
        }

        $data = Session::get('registration_data');
        
        // Generate OTP Baru & Perpanjang Waktu
        $newOtp = random_int(100000, 999999);
        $data['otp'] = $newOtp;
        $data['expires_at'] = now()->addMinutes(5);
        
        Session::put('registration_data', $data);

        // Kirim Email
        try {
            Mail::to($data['email'])->send(new OtpMail($newOtp));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim ulang email. Mohon cek koneksi atau coba lagi nanti.');
        }
        
        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}