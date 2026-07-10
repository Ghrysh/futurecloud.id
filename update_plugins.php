<?php
$orders = App\Models\Order::with(['items', 'user'])->whereIn('status', ['paid', 'active'])->get();
foreach ($orders as $order) {
    foreach ($order->items as $item) {
        if (str_contains(strtolower($item->product_name), 'plugin')) {
            $config = json_decode($item->configuration, true) ?? [];
            if (!isset($config['license_key'])) {
                $licenseKey = 'FC-LIC-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '-' . strtoupper(\Illuminate\Support\Str::random(6));
                $config['license_key'] = $licenseKey;
                $item->configuration = json_encode($config);
                $item->save();
                
                // Sync ke API
                $isChatbot = str_contains(strtolower($item->product_name), 'chatbot');
                $syncUrl = $isChatbot 
                    ? env('CHATBOT_API_URL', 'http://localhost:8081') . '/api/v1/license/sync'
                    : env('MONITORING_API_URL', 'http://localhost:8082') . '/api/v1/license/sync';
                try {
                    \Illuminate\Support\Facades\Http::post($syncUrl, [
                        'name' => $order->user->name,
                        'email' => $order->user->email,
                        'license_key' => $licenseKey,
                    ]);
                    echo "Synced {$licenseKey}\n";
                } catch (\Exception $e) {
                    echo "Failed {$licenseKey}\n";
                }
            }
        }
    }
}
echo "Done\n";
