<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailAccount;

class LoginMailController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('webmail.login');
    }

    /**
     * Memproses request login menggunakan akun email_accounts murni.
     */
    public function login(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Cari akun email di database
        $account = EmailAccount::where('email', $request->email)
            ->where('is_active', true)
            ->first();

        // 3. Validasi kecocokan password (ter-decrypt otomatis lewat Model Casting)
        if (!$account || $account->email_password !== $request->password) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Kredensial email atau password yang Anda masukkan salah.',
                ]);
        }

        // 4. Set Session Manual (Menggantikan Auth::login)
        session([
            'email_logged_in' => true,
            'email_account_id' => $account->id,
            'active_email'     => $account->email,
        ]);

        // Regenerasi session ID untuk keamanan mencegah session fixation
        $request->session()->regenerate();

        return redirect()->route('webmail.email');
    }

    /**
     * Memproses proses Logout.
     */
    public function logout(Request $request)
    {
        // Hapus data session kustom kita
        $request->session()->forget(['email_logged_in', 'email_account_id', 'active_email']);

        // Hancurkan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('webmail.login');
    }
}