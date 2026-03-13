<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotKnowledge;

class ChatbotSeeder extends Seeder
{
    public function run(): void
    {
        ChatbotKnowledge::truncate();

        $data = [
            [
                'topic' => 'Umum',
                'intent_name' => 'greeting',
                'keywords' => json_encode(['halo', 'hi', 'hai', 'selamat', 'pagi', 'siang', 'malam', 'hello']),
                'response' => 'Halo {name}! 🤖 Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?'
            ],
            [
                'topic' => 'Umum',
                'intent_name' => 'ask_identity',
                'keywords' => json_encode(['siapa kamu', 'bot', 'robot']),
                'response' => 'Saya asisten pintar FutureCloud 🤖. Saya ada di sini untuk membantu Anda mengelola layanan cloud dan bisnis SaaS Anda.'
            ],
            [
                'topic' => 'Client Area',
                'intent_name' => 'info_langganan',
                'keywords' => json_encode(['client area', 'dashboard', 'langganan', 'subscription', 'paket saya', 'login area']),
                'response' => 'Untuk melihat layanan aktif atau langganan Anda, silakan masuk ke <a href="/client-area" class="text-blue-600 underline font-bold">Client Area</a>. <br>Di sana Anda bisa mengelola VPS, Hosting, dan SaaS yang sudah dibeli.'
            ],
            [
                'topic' => 'Billing',
                'intent_name' => 'info_tagihan',
                'keywords' => json_encode(['cek tagihan', 'bayar tagihan', 'invoice', 'billing']),
                'response' => 'Tagihan Anda dapat dilihat dan dibayar melalui menu <b>Billing</b> di dalam <a href="/client-area/invoices" class="text-blue-600 underline font-bold">Client Area</a>. Kami menerima QRIS, VA Bank, dan E-Wallet.'
            ],
            [
                'topic' => 'Partner',
                'intent_name' => 'info_partner',
                'keywords' => json_encode(['partner', 'jadi partner', 'jual aplikasi', 'vendor', 'mitra']),
                'response' => 'Ingin dapat penghasilan tambahan? 💰<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>'
            ],
            [
                'topic' => 'Partner',
                'intent_name' => 'syarat_partner',
                'keywords' => json_encode(['syarat partner', 'keuntungan partner', 'komisi']),
                'response' => 'Sebagai Partner, Anda mendapatkan dashboard vendor khusus dan komisi hingga 70% dari setiap penjualan. Pastikan aplikasi Anda siap pakai (SaaS based).'
            ],
            [
                'topic' => 'Layanan',
                'intent_name' => 'info_vps',
                'keywords' => json_encode(['vps', 'virtual server', 'harga vps', 'beli server']),
                'response' => 'VPS kami menggunakan NVMe SSD super cepat! 🚀<br>Mulai dari <b>Rp 100rb/bln</b> (2 Core, 4GB RAM). <br><a href="/services/vps" class="text-blue-600 underline">Lihat Paket VPS</a>'
            ],
            [
                'topic' => 'Layanan',
                'intent_name' => 'info_domain',
                'keywords' => json_encode(['domain', 'beli domain', 'cek domain', 'harga domain']),
                'response' => 'Amankan nama brand Anda sekarang! 🌐<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.'
            ],
            [
                'topic' => 'Layanan',
                'intent_name' => 'info_hosting',
                'keywords' => json_encode(['cpanel', 'hosting cpanel']),
                'response' => 'Layanan Hosting kami sudah include lisensi <b>cPanel</b> resmi. Mudah kelola file, email, dan database. Cocok untuk pemula maupun pro.'
            ],
            [
                'topic' => 'Layanan',
                'intent_name' => 'info_saas',
                'keywords' => json_encode(['aplikasi', 'saas', 'software', 'marketplace']),
                'response' => 'Kami punya marketplace aplikasi bisnis siap pakai. Mulai dari HRIS, Kasir, hingga Manajemen Proyek. Cek katalognya di <a href="/marketplace" class="text-blue-600 underline">SaaS Marketplace</a>.'
            ],
            [
                'topic' => 'Akun',
                'intent_name' => 'info_login',
                'keywords' => json_encode(['login', 'masuk', 'sign in', 'gagal login']),
                'response' => 'Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.'
            ],
            [
                'topic' => 'Akun',
                'intent_name' => 'info_register',
                'keywords' => json_encode(['register', 'daftar', 'buat akun']),
                'response' => 'Belum punya akun? Pendaftaran gratis kok! <a href="/register" class="font-bold text-blue-600">Daftar Sekarang</a> untuk mulai belanja layanan cloud.'
            ],
        ];

        foreach ($data as $item) {
            ChatbotKnowledge::create($item);
        }
    }
}