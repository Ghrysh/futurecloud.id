<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NamecheapService;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class SyncDomainPricing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-domain-pricing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync domain pricing from Namecheap API, convert to IDR with real-time rate, add 10% margin, and round to thousands.';

    /**
     * Execute the console command.
     */
    public function handle(NamecheapService $namecheap)
    {
        $this->info("Starting domain pricing sync...");

        try {
            // 1. Dapatkan Nilai Tukar USD ke IDR Realtime
            $this->info("Mengambil nilai tukar USD ke IDR...");
            $exchangeRate = $this->getUsdToIdrRate();
            $this->info("Rate saat ini: 1 USD = Rp " . number_format($exchangeRate, 0, ',', '.'));

            // 2. Ambil Harga dari Namecheap
            $this->info("Menarik data harga dari Namecheap API...");
            $pricingList = $namecheap->getDomainPricing();
            
            if (empty($pricingList)) {
                $this->warn("Tidak ada data harga yang ditemukan dari Namecheap.");
                return;
            }

            $count = 0;
            // 3. Proses dan Simpan ke Database
            foreach ($pricingList as $item) {
                $tld = strtoupper($item['tld']); // e.g. .COM
                $priceUsd = $item['price_usd'];
                $promoUsd = $item['promo_usd'] ?? null;

                // Konversi dan Markup
                $priceIdr = $priceUsd * $exchangeRate;
                $priceWithMargin = $priceIdr * 1.10; // +10%
                $finalPrice = ceil($priceWithMargin / 1000) * 1000;

                $finalDiscountPrice = null;
                if ($promoUsd) {
                    $promoIdr = $promoUsd * $exchangeRate;
                    $promoWithMargin = $promoIdr * 1.10; // +10%
                    $finalDiscountPrice = ceil($promoWithMargin / 1000) * 1000;
                }

                // Update atau Create di DB
                Product::updateOrCreate(
                    [
                        'type' => 'domain',
                        'name' => $tld
                    ],
                    [
                        'price' => $finalPrice,
                        'discount_price' => $finalDiscountPrice,
                        'slug' => 'tld-' . strtolower(str_replace('.', '', $tld)),
                        'is_active' => true,
                    ]
                );
                
                $count++;
            }

            $this->info("Selesai! $count TLD berhasil disinkronkan.");
            Log::info("Domain pricing sync completed. $count TLDs updated at rate 1 USD = $exchangeRate IDR.");

        } catch (Exception $e) {
            $this->error("Terjadi Kesalahan: " . $e->getMessage());
            Log::error("SyncDomainPricing Error: " . $e->getMessage());
        }
    }

    /**
     * Mengambil kurs USD ke IDR menggunakan public API
     */
    private function getUsdToIdrRate(): float
    {
        try {
            // Menggunakan API gratis tanpa API Key
            $response = Http::get('https://open.er-api.com/v6/latest/USD');
            
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['rates']['IDR'])) {
                    return (float) $data['rates']['IDR'];
                }
            }
        } catch (Exception $e) {
            Log::warning("Gagal mengambil kurs realtime: " . $e->getMessage());
        }

        // Fallback jika API gagal
        return 16000;
    }
}
