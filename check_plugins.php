<?php
$orders = App\Models\Order::with(['items', 'user'])->whereIn('status', ['paid', 'active'])->get();
foreach ($orders as $order) {
    foreach ($order->items as $item) {
        $product = App\Models\SaasProduct::where('name', $item->product_name)->first();
        if ($product && strtolower($product->category) === 'plugin') {
            $config = json_decode($item->configuration, true) ?? [];
            if (!isset($config['license_key'])) {
                echo "Order {$order->id} item {$item->id} missing license key\n";
            } else {
                echo "Order {$order->id} item {$item->id} HAS license key: {$config['license_key']}\n";
            }
        }
    }
}
echo "Check Done\n";
