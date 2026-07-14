<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(Illuminate\Http\Request::capture());

try {
    $licenseKey = 'TEST-' . rand(1000, 9999);
    $res = \Illuminate\Support\Facades\DB::connection('plugin_db')
        ->table('clients')
        ->updateOrInsert(
            ['license_key' => $licenseKey],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'status' => 'active',
                'subscription_expires_at' => now()->addYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    echo "SUCCESS: " . json_encode($res);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
