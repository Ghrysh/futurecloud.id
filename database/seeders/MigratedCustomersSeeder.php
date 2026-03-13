<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MigratedCustomersSeeder extends Seeder
{
    public function run(): void
    {
        // KUMPULAN DATA PELANGGAN LAMA
        $customers = [
            // 1. SIXPERIENCE
            [
                'company' => 'Sixperience',
                'name' => 'Admin Sixperience',
                'email' => 'info@sixperience.id',
                'username' => 'sixperience',
                'password' => 'P@ssw0rd4lw4yspr4y123',
                'total_amount' => 3300000,
                'paid_days_ago' => 5,
                'items' => [
                    [
                        'name' => 'Premium Domain (sixperience.id)',
                        'type' => 'domain',
                        'price' => 1800000,
                        'cycle' => '1 Year(s)',
                        'config' => [
                            'years' => 1,
                            'domain' => 'sixperience.id',
                            'notes' => 'Migrated Service',
                            'datacenter' => 'SG'
                        ]
                    ],
                    [
                        'name' => 'Shared Hosting Business',
                        'type' => 'hosting',
                        'price' => 1500000,
                        'cycle' => 'annually',
                        'config' => [
                            'domain_connection' => 'sixperience.id',
                            'ip_address' => '209.74.67.113',
                            'username' => 'sixperience',
                            'password' => 'P@ssw0rd4lw4yspr4y123',
                            'datacenter' => 'SG'
                        ]
                    ]
                ]
            ],

            // 2. DNY FILTER INDONESIA
            [
                'company' => 'DNY Filter',
                'name' => 'Admin DNY Filter',
                'email' => 'info@dny-filterindo.co.id',
                'username' => 'dnyfilterindo',
                'password' => 'P@ssw0rd4lw4yspr4y123',
                'total_amount' => 1500000,
                'paid_days_ago' => 2,
                'items' => [
                    [
                        'name' => 'Shared Hosting (Include Domain)',
                        'type' => 'hosting',
                        'price' => 1500000,
                        'cycle' => 'annually',
                        'config' => [
                            'domain_connection' => 'dny-filterindo.co.id',
                            'ip_address' => '209.74.67.113',
                            'username' => 'dnyfilterindo',
                            'password' => 'P@ssw0rd4lw4yspr4y123',
                            'datacenter' => 'SG',
                            'notes' => 'Bundling Hosting + Domain'
                        ]
                    ]
                ]
            ],

            // 3. FKUB JAKPUS
            [
                'company' => 'FKUB Jakpus',
                'name' => 'Admin FKUB Jakpus',
                'email' => 'info@fkubjakpus.or.id',
                'username' => 'fkubjakpus',
                'password' => 'P@ssw0rd4lw4yspr4y123',
                'total_amount' => 1500000,
                'paid_days_ago' => 2,
                'items' => [
                    [
                        'name' => 'Shared Hosting (Include Domain)',
                        'type' => 'hosting',
                        'price' => 1500000,
                        'cycle' => 'annually',
                        'config' => [
                            'domain_connection' => 'fkubjakpus.or.id',
                            'ip_address' => '209.74.67.113',
                            'username' => 'fkubjakpus',
                            'password' => 'P@ssw0rd4lw4yspr4y123',
                            'datacenter' => 'SG',
                            'notes' => 'Bundling Hosting + Domain'
                        ]
                    ]
                ]
            ],
        ];

        // --- PROSES LOOPING ---
        foreach ($customers as $c) {
            
            // 1. Pecah Nama (Wajib untuk mengisi first_name)
            $nameParts = explode(' ', $c['name'], 2);
            $firstName = $nameParts[0];
            $lastName  = $nameParts[1] ?? $c['username']; // Fallback jika nama cuma 1 kata

            // 2. Buat / Update User
            $user = User::updateOrCreate(
                ['email' => $c['email']],
                [
                    'name' => $c['name'],
                    'first_name' => $firstName, // Mengatasi Error Not Null Violation
                    'last_name' => $lastName,   // Mengatasi Error Not Null Violation
                    'username' => $c['username'],
                    'password' => Hash::make($c['password']),
                    'email_verified_at' => now(),
                ]
            );

            // 3. Buat Order Utama
            $order = Order::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-MIG-' . strtoupper(Str::random(6)),
                'total_amount' => $c['total_amount'],
                'payment_method' => 'bank_transfer',
                'status' => 'paid',
                'paid_at' => Carbon::now()->subDays($c['paid_days_ago']),
                'created_at' => Carbon::now()->subDays($c['paid_days_ago']),
            ]);

            // 4. Buat Item Layanan
            foreach ($c['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item['name'],
                    'type' => $item['type'],
                    'price' => $item['price'],
                    'billing_cycle' => $item['cycle'],
                    'configuration' => $item['config']
                ]);
            }

            $this->command->info("Data {$c['company']} berhasil dibuat.");
        }
    }
}