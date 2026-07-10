<?php
$orders = App\Models\Order::with(['items'])->get();
$pluginOrdersCount = 0;
foreach ($orders as $order) {
    foreach ($order->items as $item) {
        $product = App\Models\SaasProduct::where('name', $item->product_name)->first();
        if ($product && strtolower($product->category) === 'plugin') {
            $pluginOrdersCount++;
            echo "Plugin order found: order_id={$order->id}, status={$order->status}\n";
        }
    }
}
echo "Total plugin orders: {$pluginOrdersCount}\n";
