<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;

class VirtualminService
{
    protected $host;
    protected $user;
    protected $pass;

    public function __construct()
    {
        $this->host = env('VIRTUALMIN_HOST'); // https://127.0.0.1:10000
        $this->user = env('VIRTUALMIN_USER');
        $this->pass = env('VIRTUALMIN_PASS');
    }

    /**
     * Membuat Virtual Server (Akun Hosting Baru)
     */
    public function createAccount($domain, $username, $password, $email, $plan = 'Default Plan')
    {
        // Endpoint API Virtualmin
        $url = $this->host . '/virtual-server/remote.cgi';

        // Parameter untuk membuat server baru
        $params = [
            'program' => 'create-domain', // Perintah Virtualmin
            'domain' => $domain,
            'pass' => $password,
            'user' => $username,
            'email' => $email,
            'plan' => $plan,     // Nama paket di Virtualmin
            'web' => 1,          // Aktifkan Website
            'dns' => 1,          // Aktifkan DNS
            'mail' => 1,         // Aktifkan Email
            'mysql' => 1,        // Aktifkan Database
            'json' => 1,         // Minta respon JSON
        ];

        try {
            // Virtualmin menggunakan Basic Auth (User & Pass)
            $response = Http::withoutVerifying()
                ->withBasicAuth($this->user, $this->pass)
                ->get($url, $params);

            if ($response->failed()) {
                throw new Exception("Koneksi ke Virtualmin Gagal: " . $response->status());
            }

            $result = $response->json();

            // Cek Status Sukses dari Virtualmin
            if (isset($result['status']) && $result['status'] === 'success') {
                return [
                    'success' => true,
                    'username' => $username,
                    'password' => $password,
                    'domain' => $domain,
                    'msg' => 'Akun Virtualmin berhasil dibuat'
                ];
            } else {
                // Ambil pesan error
                $errorMsg = $result['error'] ?? 'Gagal membuat akun (Unknown Error)';
                throw new Exception($errorMsg);
            }

        } catch (Exception $e) {
            Log::error("Virtualmin Error: " . $e->getMessage());
            throw new Exception("Virtualmin Error: " . $e->getMessage());
        }
    }
}