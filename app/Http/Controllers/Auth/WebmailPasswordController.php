<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailAccount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebmailPasswordController extends Controller
{
    /**
     * Tampilkan halaman form reset password
     */
    public function showResetForm()
    {
        return view('webmail.reset-password');
    }

    /**
     * Proses update password ke Mailcow API dan DB Lokal
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed', // min:8 disesuaikan dengan policy Mailcow
        ], [
            'email.required'     => 'Alamat email wajib diisi.',
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        $email = $request->email;
        $newPassword = $request->password;
        $ipAddress = $request->ip();

        // Log inisiasi proses reset password
        Log::info("Mencoba reset password untuk email: {$email} dari IP: {$ipAddress}");

        // 2. Cek apakah email terdaftar di DB Lokal Laravel
        $emailAccount = EmailAccount::where('email', $email)->first();

        if (!$emailAccount) {
            Log::warning("Gagal reset password: Email {$email} tidak ditemukan di database lokal. IP: {$ipAddress}");
            return back()->withInput()->withErrors(['email' => 'Alamat email tidak terdaftar di sistem lokal.']);
        }

        // 3. Setup API Mailcow Langsung di Sini
        $apiUrl = 'https://mail.futurecloud.id/api/v1';
        $apiKey = '8289EC-A4CDB3-ABBE9B-5F011C-68C1E0';

        Log::info("Mengirim permintaan perubahan password ke Mailcow API untuk email: {$email}");

        try {
            // Tembak endpoint Mailcow secara eksplisit
            $response = Http::withHeaders([
                'X-API-Key'    => $apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$apiUrl}/edit/mailbox", [
                'attr' => [
                    'password'  => $newPassword,
                    'password2' => $newPassword,
                ],
                'items' => [$email]
            ]);

            $responseData = $response->json();

            // Memastikan API merespon sukses
            if ($response->successful() && isset($responseData[0]['type']) && $responseData[0]['type'] === 'success') {
                
                // 4. Update ke Database Lokal Laravel
                $emailAccount->update([
                    'email_password' => $newPassword 
                ]);

                Log::info("Sukses: Password email {$email} berhasil diperbarui di Mailcow API dan database lokal. IP: {$ipAddress}");

                return redirect()->back()->with('success', 'Password email sukses diperbarui di server Mailcow dan database lokal!');
            }

            // Jika API merespon tapi mengembalikan tipe error (misal: password tidak memenuhi policy Mailcow)
            $errorMessage = $responseData[0]['msg'] ?? 'Gagal memperbarui password di server Mailcow.';
            
            Log::error("Gagal API Mailcow: Proses reset password {$email} ditolak oleh Mailcow. Alasan: {$errorMessage}", [
                'response' => $responseData
            ]);

            return back()->withInput()->withErrors(['error_global' => $errorMessage]);

        } catch (\Exception $e) {
            Log::error("Exception Mailcow: Terjadi kesalahan sistem saat reset password {$email}. Pesan: " . $e->getMessage());
            return back()->withInput()->withErrors(['error_global' => 'Terjadi kesalahan koneksi ke server mail. Silakan coba lagi nanti.']);
        }
    }
}