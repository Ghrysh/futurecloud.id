<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mailcow = new \App\Services\MailcowService();
$domains = $mailcow->getDomains();
print_r(array_slice($domains, 0, 1));
