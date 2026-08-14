<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ChatbotKnowledge;

class ChatbotKnowledgeSeeder extends Seeder
{
    public function run()
    {
        DB::table('chatbot_knowledges')->truncate();

        $knowledges = [
            [
                'topic' => 'Tentang Perusahaan',
                'intent_name' => 'about_futurecloud',
                'keywords' => json_encode(['siapa', 'apa itu futurecloud', 'profil', 'perusahaan', 'tentang', 'future cloud']),
                'response' => 'FutureCloud adalah penyedia layanan infrastruktur komputasi awan (Cloud), pendaftaran Domain, VPS (Virtual Private Server), Web Hosting, serta pengembangan perangkat lunak SaaS terkemuka di Indonesia. Kami berfokus pada kecepatan, keamanan, dan keandalan server untuk mendukung bisnis go-digital.'
            ],
            [
                'topic' => 'Layanan Utama',
                'intent_name' => 'main_services',
                'keywords' => json_encode(['layanan', 'jasa', 'produk apa saja', 'menyediakan apa', 'bisa buat', 'jual apa']),
                'response' => 'Kami menyediakan 4 layanan utama: 1) Pendaftaran & Transfer Domain (.com, .id, dll). 2) Cloud VPS berkinerja tinggi. 3) Managed Web Hosting & cPanel. 4) Layanan SaaS (Software as a Service) dan pembuatan website / aplikasi custom sesuai pesanan.'
            ],
            [
                'topic' => 'Keunggulan / Benefit',
                'intent_name' => 'benefits',
                'keywords' => json_encode(['keunggulan', 'kelebihan', 'kenapa harus', 'benefit', 'bedanya', 'alasan']),
                'response' => 'Keunggulan FutureCloud: 1) Uptime 99.9% dijamin SLA. 2) Bantuan teknis (Support) 24/7. 3) Server dengan penyimpanan NVMe SSD yang sangat cepat. 4) Integrasi pendaftaran domain instan tanpa ribet.'
            ],
            [
                'topic' => 'Proses Aktivasi (Domain & VPS)',
                'intent_name' => 'activation_process',
                'keywords' => json_encode(['berapa lama', 'aktivasi', 'aktifnya kapan', 'proses pendaftaran', 'setelah bayar']),
                'response' => 'Aktivasi layanan di FutureCloud sepenuhnya otomatis! Setelah pembayaran Anda terkonfirmasi sukses, Domain akan langsung terdaftar secara realtime dan VPS/Hosting Anda akan langsung aktif dalam hitungan menit.'
            ],
            [
                'topic' => 'Metode Pembayaran',
                'intent_name' => 'payment_methods',
                'keywords' => json_encode(['bayar pakai apa', 'cara bayar', 'pembayaran', 'transfer', 'qris', 'rekening']),
                'response' => 'Anda bisa melakukan pembayaran melalui Transfer Bank Virtual Account (BCA, BNI, Mandiri, BRI), QRIS, maupun E-Wallet (OVO, Dana, GoPay). Proses konfirmasi pembayaran dilakukan secara otomatis oleh sistem.'
            ],
            [
                'topic' => 'Kebijakan Pengembalian Dana (Refund)',
                'intent_name' => 'refund_policy',
                'keywords' => json_encode(['refund', 'garansi uang kembali', 'pengembalian dana', 'batal', 'uang kembali']),
                'response' => 'Kami memberikan Garansi Uang Kembali 30 Hari untuk layanan Hosting (syarat & ketentuan berlaku). Namun, untuk pendaftaran nama domain, biaya tidak dapat di-refund karena domain yang sudah didaftarkan tidak dapat dibatalkan.'
            ],
            [
                'topic' => 'Kontak Support & Lokasi',
                'intent_name' => 'contact_info',
                'keywords' => json_encode(['alamat', 'lokasi', 'kantor', 'hubungi', 'whatsapp', 'email', 'nomor telepon']),
                'response' => 'Anda dapat menghubungi tim bantuan kami melalui Live Chat di website, Email ke support@futurecloud.id, atau melalui Sistem Tiket di Client Area. Kantor pusat kami berlokasi di Jakarta, Indonesia.'
            ],
            [
                'topic' => 'Pendaftaran Akun Baru',
                'intent_name' => 'register_account',
                'keywords' => json_encode(['cara daftar', 'bikin akun', 'register', 'buat akun baru']),
                'response' => 'Untuk mulai berlangganan, Anda cukup mengklik tombol "Daftar" atau "Client Area" di pojok kanan atas website kami, lalu isi data diri Anda. Pendaftaran 100% gratis tanpa biaya bulanan untuk akun.'
            ],
            [
                'topic' => 'Panduan Transfer Domain',
                'intent_name' => 'transfer_domain',
                'keywords' => json_encode(['transfer domain', 'pindah domain', 'pindahkan domain', 'migrasi domain']),
                'response' => 'Tentu bisa! Anda dapat mentransfer domain Anda dari provider lama ke FutureCloud. Pastikan domain Anda sudah dibuka kuncinya (Unlock) di provider lama dan Anda memiliki kode EPP (Auth Code).'
            ],
            [
                'topic' => 'Layanan SaaS',
                'intent_name' => 'saas_info',
                'keywords' => json_encode(['saas', 'aplikasi jadi', 'bikin aplikasi', 'pesan website', 'custom app']),
                'response' => 'Layanan SaaS (Software as a Service) kami menawarkan berbagai aplikasi siap pakai seperti Sistem ERP, Aplikasi POS/Kasir, dan Web Company Profile. Kami juga melayani pembuatan aplikasi kustom (Custom Development) sesuai alur bisnis Anda.'
            ]
        ];

        foreach ($knowledges as $k) {
            ChatbotKnowledge::create($k);
        }
    }
}
