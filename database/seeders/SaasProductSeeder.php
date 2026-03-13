<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaasProduct;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class SaasProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan Data Lama
        Schema::disableForeignKeyConstraints();
        SaasProduct::truncate();
        Schema::enableForeignKeyConstraints();

        // Pastikan ada user admin (ID 1) atau buat baru
        $adminUser = User::firstOrNew(['id' => 1]);
        if (!$adminUser->exists) {
            $adminUser->fill([
                'name' => 'FutureCloud Official',
                'email' => 'admin@futurecloud.id',
                'password' => bcrypt('password'),
            ])->save();
        }

        // ==========================================
        // DATA REAL NAMECHEAP SAAS
        // ==========================================
        
        $products = [
            // 1. BUSINESS EMAIL
            [
                'name' => 'Professional Business Email',
                'slug' => 'business-email',
                'category' => 'Productivity',
                'tagline' => 'Email profesional aman, bebas iklan dengan domain Anda sendiri.',
                'description' => "Tingkatkan kredibilitas bisnis Anda dengan email domain sendiri. Pilih paket tahunan untuk hemat atau coba gratis selama 2 bulan.\n\nFitur Utama:\n- POP3/IMAP/Webmail Access\n- Anti-Spam Protection\n- 2FA Security\n- Full Mobile Sync",
                'price' => 18000, 
                'thumbnail' => 'assets/Saas/email.jpg',
                'plans' => [
                    'ultimate' => [
                        'name' => 'Ultimate', 'tag' => 'Best Value',
                        'yearly' => ['price_mo' => 73000, 'save_text' => 'Save 33%', 'total_year' => 876000, 'renew_text' => 'Renews at Rp 1.305.000/yr'],
                        'trial' => ['price_mo' => 0, 'save_text' => 'Free 2 Months', 'total_year' => 0, 'renew_text' => 'Renews at Rp 1.305.000/yr'],
                        'features' => ['5 mailboxes', '75GB storage', 'Docs & Sheets', 'Premium Delivery']
                    ],
                    'pro' => [
                        'name' => 'Pro', 'tag' => null,
                        'yearly' => ['price_mo' => 46000, 'save_text' => 'Save 28%', 'total_year' => 552000, 'renew_text' => 'Renews at Rp 760.000/yr'],
                        'trial' => ['price_mo' => 0, 'save_text' => 'Free 2 Months', 'total_year' => 0, 'renew_text' => 'Renews at Rp 760.000/yr'],
                        'features' => ['3 mailboxes', '30GB storage', 'Mobile sync']
                    ],
                    'starter' => [
                        'name' => 'Starter', 'tag' => null,
                        'yearly' => ['price_mo' => 18000, 'save_text' => 'Save 20%', 'total_year' => 216000, 'renew_text' => 'Renews at Rp 270.000/yr'],
                        'trial' => ['price_mo' => 0, 'save_text' => 'Free 2 Months', 'total_year' => 0, 'renew_text' => 'Renews at Rp 270.000/yr'],
                        'features' => ['1 mailbox', '5GB storage']
                    ]
                ]
            ],

            // 2. FASTVPN
            [
                'name' => 'FastVPN Secure Proxy',
                'slug' => 'fast-vpn',
                'category' => 'Security',
                'tagline' => 'Aman, Cepat, dan Anonim. Buka blokir konten di mana saja.',
                'description' => "Lindungi privasi online Anda dengan FastVPN. Enkripsi tingkat militer menyembunyikan IP Anda dari peretas dan pelacak.\n\nFitur Utama:\n- 1000+ Server di 50+ Negara\n- No-Logs Policy\n- Unlimited Devices\n- Unblock Netflix/Streaming",
                'price' => 18000, 
                'thumbnail' => 'assets/Saas/vpn.jpg',
                'plans' => [
                    'monthly' => [
                        'name' => 'Monthly Plan', 'price_display' => 18000, 'price_crossed' => 145000, 'discount_tag' => '87% off', 'renew_text' => 'Renews at Rp 145.000/mo', 'btn_text' => 'Get 1-month plan', 'cycle' => 'monthly', 'real_price' => 18000
                    ],
                    'yearly' => [
                        'name' => '1-year plan', 'tag' => 'PROMO', 'discount_tag' => '65% off', 'price_display' => 18500, 'total_text' => 'You pay Rp 222.000', 'renew_text' => 'Renews at Rp 640.000/yr', 'btn_text' => 'Get 1-year plan', 'cycle' => 'annually', 'real_price' => 222000
                    ],
                    'triennially' => [
                        'name' => '3-year plan', 'discount_tag' => '76% off', 'price_display' => 35000, 'total_text' => 'You pay Rp 1.260.000', 'renew_text' => '', 'btn_text' => 'Get 3-year plan', 'cycle' => 'triennially', 'real_price' => 1260000
                    ]
                ]
            ],

            // 3. SSL CERTIFICATES
            [
                'name' => 'SSL Certificates',
                'slug' => 'ssl-certificates',
                'category' => 'Security',
                'tagline' => 'Amankan website Anda dengan enkripsi standar industri.',
                'description' => "Pilih dari berbagai jenis sertifikat SSL untuk kebutuhan personal, bisnis, hingga e-commerce.\n\nFitur Umum:\n- Enkripsi 256-bit\n- Tanda Gembok HTTPS\n- Meningkatkan SEO\n- Garansi Uang Kembali",
                'price' => 109000, 
                'thumbnail' => 'assets/Saas/ssl.jpg',
                'plans' => [
                    'positive_ssl' => ['name' => 'PositiveSSL', 'price_display' => 109000, 'real_price' => 109000, 'renew_text' => 'Renews at Rp 127.000/yr', 'discount_tag' => '14% off', 'features' => ['Domain (DV)', 'Single Domain'], 'cycle' => 'annually'],
                    'essential_ssl' => ['name' => 'EssentialSSL', 'price_display' => 253000, 'real_price' => 253000, 'renew_text' => 'Renews at Rp 303.000/yr', 'discount_tag' => '17% off', 'features' => ['Domain (DV)', 'Single Domain'], 'cycle' => 'annually'],
                    'ev_ssl' => ['name' => 'EV SSL', 'price_display' => 835000, 'real_price' => 835000, 'renew_text' => 'Renews at Rp 1.002.000/yr', 'discount_tag' => '17% off', 'features' => ['Extended (EV)', 'Single Domain'], 'cycle' => 'annually'],
                    'positive_wildcard' => ['name' => 'PositiveSSL Wildcard', 'price_display' => 726000, 'real_price' => 726000, 'renew_text' => 'Renews at Rp 806.000/yr', 'discount_tag' => '10% off', 'features' => ['Domain (DV)', 'Wildcard'], 'cycle' => 'annually'],
                    'premium_ssl' => ['name' => 'PremiumSSL', 'price_display' => 908000, 'real_price' => 908000, 'renew_text' => 'Renews at Rp 1.089.000/yr', 'discount_tag' => '17% off', 'features' => ['Organization (OV)', 'Single Domain'], 'cycle' => 'annually'],
                    'multi_domain' => ['name' => 'PositiveSSL Multi-Domain', 'price_display' => 354000, 'real_price' => 354000, 'renew_text' => 'Renews at Rp 425.000/yr', 'discount_tag' => '17% off', 'tag' => '3 Domains', 'features' => ['Domain (DV)', 'Multi Domain'], 'cycle' => 'annually'],
                ]
            ],
        ];

        foreach ($products as $p) {
            // --- LOGIKA EKSTRAK FITUR AGAR TIDAK NULL ---
            $featuresList = [];
            $lines = explode("\n", $p['description']);
            foreach($lines as $line) {
                if(trim($line) && str_starts_with(trim($line), '-')) {
                    $featuresList[] = trim(substr(trim($line), 1));
                }
            }
            // Jika kosong, isi default agar tidak error NOT NULL
            if(empty($featuresList)) {
                $featuresList = ['Standard Feature'];
            }

            SaasProduct::create([
                'user_id' => $adminUser->id,
                'name' => $p['name'],
                'slug' => $p['slug'],
                'category' => $p['category'],
                'tagline' => $p['tagline'],
                'description' => $p['description'],
                'price' => $p['price'],
                'thumbnail' => $p['thumbnail'],
                'status' => 'approved',
                'plans' => $p['plans'],
                'features' => $featuresList // <--- PERBAIKAN: Field ini sekarang terisi
            ]);
        }
    }
}