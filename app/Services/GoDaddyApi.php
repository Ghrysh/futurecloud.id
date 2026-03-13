<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GoDaddyApi
{
    protected $baseUrl;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->baseUrl = env('GODADDY_BASE_URL', 'https://api.godaddy.com/v1');
        // Kita pecah key agar lebih mudah debug
        $credentials = explode(':', env('GODADDY_SSO_KEY'));
        $this->key = $credentials[0] ?? '';
        $this->secret = $credentials[1] ?? '';
    }

    protected function getClient()
    {
        // return Http::withHeaders([
        return Http::withoutVerifying() 
            ->withHeaders([
            'Authorization' => 'sso-key ' . $this->key . ':' . $this->secret,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])->baseUrl($this->baseUrl);
    }

    /**
     * 1. CREATE SUB-ACCOUNT (SHOPPER)
     */
    public function createShopper($userData)
    {
        // 1. Password Dinamis & Kuat
        $dynamicPassword = 'Future' . rand(1000, 9999) . '!Cloud';

        // 2. PERBAIKAN DI SINI (External ID harus INTEGER MURNI)
        // Kita gabungkan ID User dengan 4 angka acak agar unik, tapi tetap berupa angka.
        // Contoh: User ID 5 -> Jadi 54832 (Integer)
        $uniqueExternalId = (int) ($userData['id'] . rand(1000, 9999));

        // 3. Fallback Nama Belakang (Jaga-jaga)
        $lastName = $userData['name_last'];
        if (empty($lastName) || $lastName == '.') {
            $lastName = 'Partner';
        }

        $body = [
            'email' => $userData['email'],
            'externalId' => $uniqueExternalId,
            'marketId' => 'en-US',
            'nameFirst' => $userData['name_first'],
            'nameLast' => $lastName,
            'password' => $dynamicPassword, 
        ];

        $response = $this->getClient()->post('/shoppers/subaccount', $body);

        if ($response->failed()) {
            $errorJson = $response->json();
            $errorMessage = json_encode($errorJson, JSON_PRETTY_PRINT);
            throw new Exception("GoDaddy Reject: " . $errorMessage);
        }

        return $response->json()['shopperId'];
    }

    /**
     * 2. CEK KETERSEDIAAN
     * PERBAIKAN: Nama fungsi diganti menjadi checkDomainAvailability
     * Agar sesuai dengan panggilan di Controller.
     */
    public function checkDomainAvailability($domain) 
    {
        $response = $this->getClient()->get('/domains/available', [
            'domain' => $domain,
            'checkType' => 'FAST', 
            'forTransfer' => 'false'
        ]);

        if ($response->failed()) {
            // Jika error, kita lempar exception agar ditangkap controller
            // Dan controller akan mengaktifkan mode simulasi
            throw new Exception("Gagal cek domain: " . $response->body());
        }

        return $response->json();
    }

    /**
     * 3. BELI DOMAIN (Purchase)
     */
    public function purchaseDomain($shopperId, $domain, $contactData)
    {
        $body = [
            'domain' => $domain,
            'consent' => [
                'agreementKeys' => ['DNRA'], 
                'agreedBy' => request()->ip(),
                'agreedAt' => now()->toIso8601String(),
            ],
            'period' => 1, 
            'renewAuto' => true,
            'privacy' => false,
            'contactAdmin' => $contactData,
            'contactRegistrant' => $contactData,
            'contactTech' => $contactData,
            'contactBilling' => $contactData,
        ];

        $response = $this->getClient()
            ->withHeaders(['X-Shopper-Id' => $shopperId]) 
            ->post('/domains/purchase', $body);

        if ($response->failed()) {
            throw new Exception("Gagal Beli Domain: " . $response->body());
        }

        return $response->json();
    }
}