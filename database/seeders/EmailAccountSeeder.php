<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailAccount;

class EmailAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailAccount::updateOrCreate(
            // Kondisi untuk mengecek apakah email ini sudah terdaftar (mencegah duplikasi)
            ['email' => 'arifin@futurecloud.id'],
            
            // Data yang akan dimasukkan atau diperbarui
            [
                'email_password'     => 'BTToKE2026@#', // Otomatis terenkripsi aman berkat Eloquent Casts
                'imap_host'          => 'mail.futurecloud.id',
                'imap_port'          => 993,
                'imap_encryption'    => 'ssl',
                'imap_protocol'      => 'imap',
                'imap_validate_cert' => false,
                'smtp_host'          => 'mail.futurecloud.id',
                'smtp_port'          => 465,
                'smtp_encryption'    => 'ssl',
                'is_active'          => true,
            ]
        );
    }
}