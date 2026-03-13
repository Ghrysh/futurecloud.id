<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        DB::table('portfolios')->insert([
            [
                'title' => 'E-Commerce Fashion Muslim',
                'slug' => Str::slug('E-Commerce Fashion Muslim'),
                'category' => 'Web Development',
                'url' => 'https://tokocontoh.id',
                'description' => 'Platform toko online berkinerja tinggi dengan integrasi payment gateway midtrans dan sistem manajemen stok real-time.',
                'image' => 'portfolios/sample-1.jpg', // Pastikan nanti ada gambar dummy di storage
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sistem Informasi Rumah Sakit',
                'slug' => Str::slug('Sistem Informasi Rumah Sakit'),
                'category' => 'SaaS Application',
                'url' => 'https://rs-smart.id',
                'description' => 'Aplikasi manajemen pasien dan rekam medis elektronik berbasis cloud yang aman dan compliant dengan regulasi kesehatan.',
                'image' => 'portfolios/sample-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}