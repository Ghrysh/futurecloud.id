<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestPluginDb extends Command
{
    protected $signature = 'test:plugindb';
    protected $description = 'Test insert to plugin_db';

    public function handle()
    {
        $this->info('Testing connection to plugin_db...');
        try {
            DB::connection('plugin_db')->table('clients')->updateOrInsert(
                ['license_key' => 'TEST-' . rand(1000, 9999)],
                [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'status' => 'active',
                    'subscription_expires_at' => now()->addYear(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $this->info('SUCCESS: Data inserted to clients table.');
        } catch (\Exception $e) {
            $this->error('ERROR: ' . $e->getMessage());
        }
    }
}
