<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailAccount;

class AdditionalEmailAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [

            [
                'email' => 'syalpra@futurecloud.id',
                'email_password' => 'Syalpratama123!',
            ],
            
            [
                'email' => 'ghryshvi@futurecloud.id',
                'email_password' => 'ptbttoke!@#9hrysh123',
            ],

        ];

        foreach ($accounts as $account) {

            EmailAccount::updateOrCreate(

                ['email' => $account['email']],

                [
                    'email_password'     => $account['email_password'],
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
}