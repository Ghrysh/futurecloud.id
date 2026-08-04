<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Services\GoDaddyApi; // Import Service
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    // Mengarahkan user ke halaman login Google
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function switchAccount()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');

        return $driver
            ->with(['prompt' => 'select_account']) 
            ->redirect();
    }

    // Menangani callback setelah user login
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::where($provider . '_id', $socialUser->getId())
                        ->orWhere('email', $socialUser->getEmail())
                        ->first();

            // --- JIKA USER SUDAH ADA ---
            if ($user) {
                // Update ID Provider jika belum ada
                if (!$user->{$provider . '_id'}) {
                    $user->update([
                        $provider . '_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => $user->email_verified_at ?? now(),
                    ]);
                }
                
                // Cek apakah Shopper ID masih kosong? Jika iya, coba buatkan sekarang
                if (empty($user->godaddy_shopper_id)) {
                    $this->createGoDaddyShopper($user);
                }
            } 
            // --- JIKA USER BARU ---
            else {
                // 1. Pecah Nama (Google cuma kasih Full Name)
                $fullName = $socialUser->getName() ?? $socialUser->getNickname();
                $parts = explode(' ', $fullName, 2);
                $firstName = $parts[0];
                $lastName = $parts[1] ?? '.'; // Fallback jika tidak ada nama belakang

                // 2. Generate Username Unik (misal: budi_1234)
                $username = Str::slug($firstName) . rand(1000, 9999);

                // 3. Buat User di Database
                $user = User::create([
                    'username' => $username,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'name' => $fullName,
                    'email' => $socialUser->getEmail(),
                    'password' => null, // Password belum diset (agar bisa di-set saat lupa password)
                    $provider . '_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);

                // 4. Buat Shopper ID di GoDaddy
                $this->createGoDaddyShopper($user);
            }

            Auth::login($user);
            session()->regenerate();

            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            Log::error('Social Login Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Gagal login via Google. Silakan coba lagi.');
        }
    }

    private function createGoDaddyShopper($user)
    {
        try {
            $goDaddy = new GoDaddyApi();

            $shopperId = $goDaddy->createShopper([
                'id' => $user->id,
                'email' => $user->email,
                'name_first' => $user->first_name,
                'name_last' => $user->last_name,
            ]);

            if ($shopperId) {
                $user->update(['godaddy_shopper_id' => $shopperId]);
            }

        } catch (\Exception $e) {
            // MODE FALLBACK (Jika API GoDaddy Error/Belum Aktif)
            // Agar user Google tetap punya ID (meskipun dummy) dan tidak error di kemudian hari
            Log::warning("GoDaddy Social Login Warning: " . $e->getMessage());
            
            $dummyShopperId = 'GOOGLE-' . rand(100000, 999999);
            $user->update(['godaddy_shopper_id' => $dummyShopperId]);
        }
    }
}