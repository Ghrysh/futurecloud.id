<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaasProduct;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUserId = 1; 

        $chatbotDesc = "FutureCloud AI Chatbot Plugin adalah solusi cerdas untuk mengotomatiskan layanan pelanggan di aplikasi Anda menggunakan teknologi AI terkini.";

        $monitoringDesc = "Monitoring Visitor Plugin memberikan wawasan analitik yang mendalam mengenai lalu lintas pengunjung di website atau aplikasi Anda secara real-time, tanpa membebani performa server.";

        SaasProduct::updateOrCreate(
            ['slug' => 'chatbot-plugin'],
            [
                'user_id' => $adminUserId,
                'name' => 'Chatbot Plugin',
                'category' => 'Plugin',
                'tagline' => 'Plugin Chatbot pintar untuk integrasi instan',
                'description' => $chatbotDesc,
                'price' => 0,
                'thumbnail' => 'assets/img/placeholder.jpg',
                'status' => 'approved',
                'features' => [
                    'Kecerdasan Buatan (AI): Chatbot tidak kaku, memahami konteks percakapan secara natural dan interaktif',
                    'Kelola Pengetahuan AI (Knowledge Base): Latih AI dengan data dan pengetahuan spesifik mengenai bisnis Anda',
                    'Pantau Chat: Pantau seluruh riwayat interaksi bot dengan pengunjung secara real-time',
                    'Live Chat / Human Takeover: Ambil alih percakapan dari bot jika pelanggan membutuhkan bantuan manusia'
                ],
                'plans' => ['cycle' => 'lifetime'],
            ]
        );

        SaasProduct::updateOrCreate(
            ['slug' => 'monitoring-visitor-plugin'],
            [
                'user_id' => $adminUserId,
                'name' => 'Monitoring Visitor Plugin',
                'category' => 'Plugin',
                'tagline' => 'Plugin Monitoring Visitor secara real-time',
                'description' => $monitoringDesc,
                'price' => 0,
                'thumbnail' => 'assets/img/placeholder.jpg',
                'status' => 'approved',
                'features' => [
                    'Real-Time Analytics: Pantau jumlah pengunjung yang sedang aktif di situs Anda secara langsung',
                    'Detail Pengunjung: Lacak info lokasi geografis, jenis perangkat, browser, dan sistem operasi',
                    'Page Tracking: Ketahui halaman mana yang sedang dilihat pengunjung dan alur navigasi mereka',
                    'Dashboard Interaktif: Visualisasi metrik dan grafik yang modern dan mudah dipahami'
                ],
                'plans' => ['cycle' => 'lifetime'],
            ]
        );
    }
}
