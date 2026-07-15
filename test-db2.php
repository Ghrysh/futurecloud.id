<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$items = \App\Models\OrderItem::whereNotNull('configuration')->get();
foreach ($items as $item) {
    if(!str_contains(strtolower($item->product_name), 'plugin')) {
       echo "NON-PLUGIN NAME FOUND: " . $item->product_name . "\n";
    }
}
