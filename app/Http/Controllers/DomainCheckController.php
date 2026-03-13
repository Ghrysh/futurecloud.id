<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NamecheapService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Throwable;

class DomainCheckController extends Controller
{
    protected $provider;

    public function __construct(NamecheapService $provider)
    {
        $this->provider = $provider;
    }

    public function check(Request $request)
    {
        $rawDomain = $request->input('domain');
        // Sanitasi
        $cleanDomain = strtolower(trim(preg_replace('#^https?://#', '', $rawDomain)));
        $cleanDomain = preg_replace('#^www\.#', '', $cleanDomain);

        if (empty($cleanDomain) || !str_contains($cleanDomain, '.')) {
            return response()->json(['error' => true, 'message' => 'Format domain tidak valid.']);
        }

        $parts = explode('.', $cleanDomain, 2); 
        $sld = $parts[0];
        $originalTld = '.' . ($parts[1] ?? 'com');

        $popularTlds = ['.com', '.net', '.org', '.id', '.co.id'];
        $alternativeTlds = array_diff($popularTlds, [$originalTld]);
        $alternativeTlds = array_slice($alternativeTlds, 0, 4);

        try {
            // Main Check
            $mainResult = $this->checkSingleDomain($sld . $originalTld);

            // Alternatives Check
            $alternatives = [];
            foreach ($alternativeTlds as $altTld) {
                try {
                    $alternatives[] = $this->checkSingleDomain($sld . $altTld);
                } catch (Throwable $e) { continue; }
            }

            return response()->json([
                'main' => $mainResult,
                'alternatives' => $alternatives
            ]);

        } catch (Throwable $e) {
            Log::error("Domain API Error: " . $e->getMessage());
            return response()->json(['error' => true, 'message' => 'Sistem sedang sibuk.'], 200); 
        }
    }

    private function checkSingleDomain($domain)
    {
        // 1. Cek Availability Realtime
        $apiResult = $this->provider->checkDomain($domain);
        
        // 2. Ambil Harga DB
        $tld = substr($domain, strrpos($domain, '.')); 
        $product = Product::where('type', 'domain')->where('name', strtoupper($tld))->first();

        // Default
        $price = 150000;
        $finalPrice = 150000;
        $isDiscounted = false;
        $savePercent = 0;

        if ($product) {
            $price = $product->price;
            
            // Cek Diskon Admin
            if ($product->discount_price && $product->discount_price < $product->price) {
                $isDiscounted = true;
                $finalPrice = $product->discount_price;
                $savePercent = round((($price - $finalPrice) / $price) * 100);
            } else {
                $finalPrice = $price;
            }
        } else {
            // Fallback Logic jika produk blm ada di DB
            if ($apiResult['premium']) $price = 5000000;
            elseif (str_ends_with($domain, '.id')) $price = 250000;
            $finalPrice = $price;
        }

        return [
            'domain' => $domain,
            'available' => $apiResult['available'],
            'price_original' => $price,
            'price_final' => $finalPrice,
            'is_discounted' => $isDiscounted,
            'save_percent' => $savePercent,
            'formatted_price' => number_format($finalPrice, 0, ',', '.'),
            'formatted_original' => number_format($price, 0, ',', '.')
        ];
    }
}