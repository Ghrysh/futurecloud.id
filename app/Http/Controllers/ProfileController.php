<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
use App\Mail\OtpMail;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Validasi dan Update Data
        $data = $request->validated();
        
        $user->username = $data['username'] ?? $user->username;
        $user->first_name = $data['first_name'] ?? $user->first_name;
        $user->last_name = $data['last_name'] ?? $user->last_name;
        
        // Update Display Name (Gabungan)
        $user->name = $user->first_name . ' ' . $user->last_name;

        // Email logic (biasanya breeze punya logic verifikasi email ulang jika email diganti, tapi karena readonly kita skip)
        // if ($user->isDirty('email')) ...

        $user->save();

        return Redirect::route('client.profile')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Mengirim OTP ke email untuk mengatur kata sandi (Akun Google).
     */
    public function sendSetPasswordOtp(Request $request)
    {
        $user = $request->user();
        if ($user->password !== null) {
            return response()->json(['error' => 'Akun Anda sudah memiliki kata sandi.'], 400);
        }

        $otp = random_int(100000, 999999);
        Session::put('set_password_otp', [
            'code' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        try {
            Mail::to($user->email)->send(new OtpMail($otp));
            return response()->json(['message' => 'OTP telah dikirim ke email Anda.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengirim email OTP. Silakan coba lagi.'], 500);
        }
    }

    /**
     * Verifikasi OTP untuk mengatur kata sandi.
     */
    public function verifySetPasswordOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'digits:6']
        ], [
            'otp_code.required' => 'Kode OTP wajib diisi.',
            'otp_code.digits' => 'Kode OTP harus berupa 6 digit angka.',
        ]);

        $sessionData = Session::get('set_password_otp');

        if (!$sessionData || now()->greaterThan($sessionData['expires_at'])) {
            return response()->json(['error' => 'Sesi OTP tidak valid atau telah kedaluwarsa.'], 400);
        }

        if (strval($request->otp_code) !== strval($sessionData['code'])) {
            return response()->json(['error' => 'Kode OTP salah.'], 400);
        }

        // Tandai OTP telah diverifikasi
        Session::put('set_password_otp_verified', true);
        Session::forget('set_password_otp');

        return response()->json(['message' => 'OTP berhasil diverifikasi.']);
    }

    /**
     * Simpan kata sandi baru (setelah OTP diverifikasi).
     */
    public function setPassword(Request $request)
    {
        if (!Session::get('set_password_otp_verified')) {
            return response()->json(['error' => 'Anda harus memverifikasi OTP terlebih dahulu.'], 403);
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        Session::forget('set_password_otp_verified');

        return response()->json(['message' => 'Kata sandi berhasil diatur!']);
    }
}
