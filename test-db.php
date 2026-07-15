<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$items = \App\Models\OrderItem::where('product_name', 'like', '%Plugin%')->get();
foreach ($items as $item) {
    echo "ID: " . $item->id . " | Product: " . $item->product_name . "\n";
    echo "Config: " . json_encode($item->configuration) . "\n\n";
}
