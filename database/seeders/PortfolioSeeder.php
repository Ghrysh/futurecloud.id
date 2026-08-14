<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Portfolio; // Tambahkan ini jika belum ada

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        $portfolios = [
            [
                'title' => 'Sixperience Digital Platform',
                'category' => 'Web Development',
                'url' => 'https://sixperience.id',
                'description' => 'Platform digital interaktif terintegrasi untuk kebutuhan event organizer dan pengalaman acara yang imersif.',
            ],
            [
                'title' => 'PT DNY Filterindo Company Profile',
                'category' => 'Corporate Website',
                'url' => 'https://dny-filterindo.co.id',
                'description' => 'Website company profile profesional untuk perusahaan manufaktur filter industri dengan katalog produk yang responsif.',
            ],
            [
                'title' => 'Portal Resmi PKUB Kemenag RI',
                'category' => 'Government Portal',
                'url' => 'https://pkubpusat.kemenag.go.id',
                'description' => 'Portal informasi resmi Pusat Kerukunan Umat Beragama Kementerian Agama RI dengan sistem manajemen konten berskala nasional.',
            ],
            [
                'title' => 'Early Warning System (EWS) PKUB',
                'category' => 'Web Application',
                'url' => 'https://pkubpusat.kemenag.go.id/ews',
                'description' => 'Sistem peringatan dini berbasis web untuk mendeteksi dan mencegah potensi konflik keagamaan, dilengkapi dashboard analitik real-time.',
            ],
            [
                'title' => 'Smartrack Fleet Management',
                'category' => 'SaaS Application',
                'url' => 'https://smartrack.id',
                'description' => 'Platform manajemen armada dan pelacakan GPS kendaraan pintar dengan sistem pemantauan rute dan laporan efisiensi.',
            ],
            [
                'title' => 'ScanYuk QR Platform',
                'category' => 'Web Application',
                'url' => 'https://scanyuk.com',
                'description' => 'Platform pembuatan dan manajemen QR Code dinamis untuk kebutuhan menu restoran, ticketing, dan sistem kehadiran.',
            ],
            [
                'title' => 'Ngajak Undangan Digital',
                'category' => 'Web Application',
                'url' => 'https://ngajak.my.id',
                'description' => 'Layanan pembuatan undangan pernikahan dan acara digital (website) dengan desain elegan dan fitur RSVP interaktif.',
            ],
            [
                'title' => 'Katalog Online Wonosofa',
                'category' => 'E-Commerce',
                'url' => 'https://wonosofa.my.id',
                'description' => 'Katalog produk dan website representasi bisnis mebel/sofa dengan antarmuka bersih dan sistem pemesanan yang mudah.',
            ],
            [
                'title' => 'Vidici Corporate Website',
                'category' => 'Corporate Website',
                'url' => 'https://vidici.id',
                'description' => 'Website representasi korporat dengan desain modern dan performa tinggi untuk membangun kredibilitas merek digital.',
            ],
            [
                'title' => 'SIMSDM Kementerian Agama',
                'category' => 'Government Portal',
                'url' => 'https://simsdm.kemenag.go.id',
                'description' => 'Sistem Informasi Manajemen Sumber Daya Manusia terpadu yang dirancang khusus untuk memenuhi administrasi pegawai Kemenag.',
            ],
            [
                'title' => 'Commawear Online Store',
                'category' => 'E-Commerce',
                'url' => 'https://commawear.id',
                'description' => 'Platform e-commerce fashion modern dengan pengalaman belanja pengguna yang mulus dan manajemen katalog dinamis.',
            ],
            [
                'title' => 'FutureCloud Lead Generation',
                'category' => 'Internal Tool',
                'url' => 'https://lead.futurecloud.id',
                'description' => 'Sistem internal Customer Relationship Management (CRM) untuk menangkap, mengelola, dan mengonversi leads bisnis secara efisien.',
            ],
            [
                'title' => 'FutureCloud ERP System',
                'category' => 'SaaS Application',
                'url' => 'https://erp.futurecloud.id',
                'description' => 'Sistem Enterprise Resource Planning (ERP) berbasis cloud untuk otomasi manajemen operasional, keuangan, dan sumber daya perusahaan.',
            ],
            [
                'title' => 'Portal FKUB Jakarta Pusat',
                'category' => 'Organization Website',
                'url' => 'https://fkubjakpus.or.id',
                'description' => 'Website resmi Forum Kerukunan Umat Beragama Jakarta Pusat untuk publikasi berita, galeri, dan agenda kegiatan forum.',
            ]
        ];

        DB::table('portfolios')->truncate(); // Bersihkan data lama agar tidak duplikat

        $insertData = [];
        foreach ($portfolios as $index => $item) {
            $insertData[] = [
                'title' => $item['title'],
                'slug' => Str::slug($item['title']) . '-' . rand(100, 999), // Mencegah bentrok slug
                'category' => $item['category'],
                'url' => $item['url'],
                'description' => $item['description'],
                // Set gambar placeholder sementara 1-4 (diulang)
                'image' => 'portfolios/sample-' . (($index % 4) + 1) . '.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('portfolios')->insert($insertData);
    }
}