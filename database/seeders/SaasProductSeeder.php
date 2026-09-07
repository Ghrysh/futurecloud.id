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
        // Pastikan ada user admin (ID 1) atau buat baru
        $adminUser = User::firstOrNew(['id' => 1]);
        if (!$adminUser->exists) {
            $adminUser->fill([
                'name' => 'FutureCloud Official',
                'first_name' => 'FutureCloud',
                'last_name' => 'Official',
                'email' => 'admin@futurecloud.id',
                'password' => bcrypt('password'),
            ])->save();
        }

        $p = [
            'name' => 'Email Corporate',
            'slug' => 'email-corporate',
            'category' => 'Productivity',
            'tagline' => 'Kelola email perusahaan Anda sendiri dengan Mailcow.',
            'description' => "Dapatkan kontrol penuh atas email perusahaan Anda dengan fitur admin mandiri dan integrasi Mailcow.\n\nFitur Utama:\n- Akses Admin Panel (Clientzone)\n- Buat Mailbox Tanpa Batas (Unlimited)\n- Premium Webmail\n- Anti-Spam & Virus Protection",
            'price' => 50000, 
            'thumbnail' => 'assets/Saas/email.webp',
            'plans' => [
                'cycle' => 'monthly_yearly',
                'annual_discount_type' => 'fixed',
                'annual_discount_value' => 100000, // 12 * 50000 = 600000 - 100000 = 500000
                'corporate' => [
                    'name' => 'Email Corporate', 
                    'price' => 50000, 
                    'features' => ['Akses Admin Panel', 'Unlimited Mailbox', 'Premium Webmail', 'Anti-Spam & Virus']
                ]
            ]
        ];

        $featuresList = [];
        $lines = explode("\n", $p['description']);
        foreach($lines as $line) {
            if(trim($line) && str_starts_with(trim($line), '-')) {
                $featuresList[] = trim(substr(trim($line), 1));
            }
        }
        if(empty($featuresList)) {
            $featuresList = ['Standard Feature'];
        }

        SaasProduct::updateOrCreate(
            ['slug' => $p['slug']],
            [
                'user_id' => $adminUser->id,
                'name' => $p['name'],
                'category' => $p['category'],
                'tagline' => $p['tagline'],
                'description' => $p['description'],
                'price' => $p['price'],
                'thumbnail' => $p['thumbnail'],
                'status' => 'approved',
                'plans' => $p['plans'],
                'features' => $featuresList
            ]
        );
    }
}