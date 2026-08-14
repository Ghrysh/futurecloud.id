<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class NamecheapService
{
    protected $apiUser;
    protected $apiKey;
    protected $clientIp;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiUser = env('NAMECHEAP_USER');
        $this->apiKey = env('NAMECHEAP_KEY');
        $this->clientIp = env('NAMECHEAP_CLIENT_IP');

        // Tentukan URL Sandbox vs Production
        if (env('NAMECHEAP_ENV') === 'production') {
            $this->baseUrl = 'https://api.namecheap.com/xml.response';
        } else {
            $this->baseUrl = 'https://api.sandbox.namecheap.com/xml.response';
        }
    }

    /**
     * Cek Ketersediaan Domain
     */
    public function checkDomain($domain)
    {
        $params = [
            'ApiUser'    => $this->apiUser,
            'ApiKey'     => $this->apiKey,
            'UserName'   => $this->apiUser,
            'Command'    => 'namecheap.domains.check',
            'ClientIp'   => $this->clientIp,
            'DomainList' => $domain,
        ];

        try {
            // withoutVerifying() untuk menghindari masalah SSL di Local/VPS tertentu
            $response = Http::withoutVerifying()->get($this->baseUrl, $params);

            if ($response->failed()) {
                throw new Exception("HTTP Connection Failed: " . $response->status());
            }

            $body = $response->body();
            
            // Parse XML
            $xml = simplexml_load_string($body);
            
            // Cek Error Level API
            if (isset($xml->Errors->Error)) {
                throw new Exception("Namecheap API Error: " . (string)$xml->Errors->Error);
            }

            // Ambil Hasil Availability
            $checkResult = $xml->CommandResponse->DomainCheckResult;
            
            $isAvailable = (string)$checkResult['Available'] === 'true';
            $isPremium = (string)$checkResult['IsPremiumName'] === 'true';

            return [
                'available' => $isAvailable,
                'premium'   => $isPremium,
                'domain'    => $domain
            ];

        } catch (Exception $e) {
            Log::error("Namecheap Check Error ($domain): " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Mendaftarkan Domain Baru (POTONG SALDO)
     * 
     * @param string $domain Nama domain
     * @param int $years Durasi tahun
     * @param array $contactData Array berisi data kontak user (first_name, last_name, dll)
     */
    public function registerDomain($domain, $years = 1, $contactData = [])
    {
        // 1. Parameter Dasar
        $params = [
            'ApiUser'    => $this->apiUser,
            'ApiKey'     => $this->apiKey,
            'UserName'   => $this->apiUser,
            'Command'    => 'namecheap.domains.create',
            'ClientIp'   => $this->clientIp,
            'DomainName' => $domain,
            'Years'      => $years,
        ];

        // 2. Mapping Data Kontak
        // Namecheap mewajibkan 4 tipe kontak: Registrant, Tech, Admin, AuxBilling
        // Kita gunakan data yang sama untuk keempatnya agar praktis.
        
        $contactTypes = ['Registrant', 'Tech', 'Admin', 'AuxBilling'];

        foreach ($contactTypes as $type) {
            $params["{$type}FirstName"]     = $contactData['first_name'] ?? 'Admin';
            $params["{$type}LastName"]      = $contactData['last_name'] ?? 'User';
            $params["{$type}Address1"]      = $contactData['address'] ?? 'Jl. Digital No 1';
            $params["{$type}City"]          = $contactData['city'] ?? 'Jakarta';
            $params["{$type}StateProvince"] = $contactData['state'] ?? 'DKI Jakarta';
            $params["{$type}PostalCode"]    = $contactData['zip'] ?? '10110';
            $params["{$type}Country"]       = 'ID'; // Default Indonesia
            $params["{$type}Phone"]         = $contactData['phone'] ?? '+62.81234567890'; // Format wajib: +NN.NNNNNNN
            $params["{$type}EmailAddress"]  = $contactData['email'] ?? 'admin@futurecloud.id';
        }

        try {
            // 3. Eksekusi API
            $response = Http::withoutVerifying()->get($this->baseUrl, $params);

            if ($response->failed()) {
                throw new Exception("HTTP Error saat register domain.");
            }

            $body = $response->body();
            $xml = simplexml_load_string($body);
            
            // Cek Error API
            if (isset($xml->Errors->Error)) {
                // Log detail error untuk Admin
                Log::error("Namecheap Register Failed ($domain): " . (string)$xml->Errors->Error);
                throw new Exception("Gagal Register Domain di Namecheap: " . (string)$xml->Errors->Error);
            }

            // Ambil Result
            $result = $xml->CommandResponse->DomainCreateResult;
            
            Log::info("Domain $domain berhasil didaftarkan. OrderID: " . (string)$result['OrderId']);

            return [
                'success'   => (string)$result['Registered'] === 'true',
                'domain'    => (string)$result['Domain'],
                'order_id'  => (string)$result['OrderId'],
                'price'     => (string)$result['ChargedAmount'],
            ];

        } catch (Exception $e) {
            // Lempar error agar Controller tahu
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Mendapatkan Daftar Harga Domain (TLD) dari Namecheap
     */
    public function getDomainPricing()
    {
        $params = [
            'ApiUser'      => $this->apiUser,
            'ApiKey'       => $this->apiKey,
            'UserName'     => $this->apiUser,
            'Command'      => 'namecheap.users.getPricing',
            'ClientIp'     => $this->clientIp,
            'ProductType'  => 'DOMAIN',
            'ProductCategory' => 'REGISTER',
        ];

        try {
            $response = Http::withoutVerifying()->timeout(120)->get($this->baseUrl, $params);

            if ($response->failed()) {
                throw new Exception("HTTP Error saat getPricing.");
            }

            $body = $response->body();
            $xml = simplexml_load_string($body);

            if (isset($xml->Errors->Error)) {
                throw new Exception("Namecheap API Error (getPricing): " . (string)$xml->Errors->Error);
            }

            $pricingList = [];

            // XML Structure: UserGetPricingResult -> ProductType -> ProductCategory -> Product
            $products = $xml->CommandResponse->UserGetPricingResult->ProductType->ProductCategory->Product;
            
            if ($products) {
                foreach ($products as $product) {
                    $tld = (string)$product['Name'];
                    $priceElements = $product->Price;
                    
                    foreach ($priceElements as $priceData) {
                        // Kita ambil harga untuk 1 Tahun (Duration="1")
                        if ((string)$priceData['Duration'] === '1' && (string)$priceData['DurationType'] === 'YEAR') {
                            $promoPrice = isset($priceData['PromotionPrice']) ? (float)$priceData['PromotionPrice'] : null;
                            if ($promoPrice === 0.0) $promoPrice = null;

                            $pricingList[] = [
                                'tld' => '.' . strtolower($tld),
                                'price_usd' => (float)$priceData['Price'],
                                'promo_usd' => $promoPrice,
                                'currency' => (string)$priceData['Currency']
                            ];
                            break;
                        }
                    }
                }
            }

            return $pricingList;

        } catch (Exception $e) {
            Log::error("Namecheap GetPricing Error: " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}