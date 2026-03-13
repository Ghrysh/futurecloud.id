<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotResponse;

class ChatbotSeeder extends Seeder
{
    public function run(): void
    {
        ChatbotResponse::truncate();

        $data = [
            // GREETING
            [
                'keyword' => 'halo, hi, hai, selamat, pagi, siang, malam, hello', 
                'answer' => 'Halo {name}! ?? Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?'
            ],
            [
                'keyword' => 'siapa kamu, bot, robot', 
                'answer' => 'Saya asisten pintar FutureCloud ??. Saya ada di sini untuk membantu Anda mengelola layanan cloud dan bisnis SaaS Anda.'
            ],

            // CLIENT AREA & SUBSCRIPTION (Fitur Inti)
            [
                'keyword' => 'client area, dashboard, langganan, subscription, paket saya, login area', 
                'answer' => 'Untuk melihat layanan aktif atau langganan Anda, silakan masuk ke <a href="/client-area" class="text-blue-600 underline font-bold">Client Area</a>. <br>Di sana Anda bisa mengelola VPS, Hosting, dan SaaS yang sudah dibeli.'
            ],
            [
                'keyword' => 'cek tagihan, bayar tagihan, invoice, billing', 
                'answer' => 'Tagihan Anda dapat dilihat dan dibayar melalui menu <b>Billing</b> di dalam <a href="/client-area/invoices" class="text-blue-600 underline font-bold">Client Area</a>. Kami menerima QRIS, VA Bank, dan E-Wallet.'
            ],

            // PARTNER SYSTEM (Fitur Inti)
            [
                'keyword' => 'partner, jadi partner, jual aplikasi, vendor, mitra', 
                'answer' => 'Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>'
            ],
            [
                'keyword' => 'syarat partner, keuntungan partner, komisi', 
                'answer' => 'Sebagai Partner, Anda mendapatkan dashboard vendor khusus dan komisi hingga 70% dari setiap penjualan. Pastikan aplikasi Anda siap pakai (SaaS based).'
            ],

            // SERVICES - VPS & DOMAIN
            [
                'keyword' => 'vps, virtual server, harga vps, beli server', 
                'answer' => 'VPS kami menggunakan NVMe SSD super cepat! ??<br>Mulai dari <b>Rp 100rb/bln</b> (2 Core, 4GB RAM). <br><a href="/services/vps" class="text-blue-600 underline">Lihat Paket VPS</a>'
            ],
            [
                'keyword' => 'domain, beli domain, cek domain, harga domain', 
                'answer' => 'Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.'
            ],
            [
                'keyword' => 'cpanel, hosting cpanel', 
                'answer' => 'Layanan Hosting kami sudah include lisensi <b>cPanel</b> resmi. Mudah kelola file, email, dan database. Cocok untuk pemula maupun pro.'
            ],

            // SAAS APPS
            [
                'keyword' => 'aplikasi, saas, software, marketplace', 
                'answer' => 'Kami punya marketplace aplikasi bisnis siap pakai. Mulai dari HRIS, Kasir, hingga Manajemen Proyek. Cek katalognya di <a href="/marketplace" class="text-blue-600 underline">SaaS Marketplace</a>.'
            ],
            
            // AKUN
            [
                'keyword' => 'login, masuk, sign in, gagal login', 
                'answer' => 'Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.'
            ],
            [
                'keyword' => 'register, daftar, buat akun', 
                'answer' => 'Belum punya akun? Pendaftaran gratis kok! <a href="/register" class="font-bold text-blue-600">Daftar Sekarang</a> untuk mulai belanja layanan cloud.'
            ],
        ];

        foreach ($data as $item) {
            ChatbotResponse::create($item);
        }
    }
}