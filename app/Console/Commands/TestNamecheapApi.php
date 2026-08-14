<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NamecheapService;
use Illuminate\Support\Facades\Http;

class TestNamecheapApi extends Command
{
    protected $signature = 'app:test-namecheap';
    protected $description = 'Test Namecheap API and dump XML';

    public function handle(NamecheapService $namecheap)
    {
        // Reflection to get private properties
        $reflection = new \ReflectionClass($namecheap);
        
        $apiUserProp = $reflection->getProperty('apiUser');
        $apiUserProp->setAccessible(true);
        $apiUser = $apiUserProp->getValue($namecheap);
        
        $apiKeyProp = $reflection->getProperty('apiKey');
        $apiKeyProp->setAccessible(true);
        $apiKey = $apiKeyProp->getValue($namecheap);
        
        $clientIpProp = $reflection->getProperty('clientIp');
        $clientIpProp->setAccessible(true);
        $clientIp = $clientIpProp->getValue($namecheap);
        
        $baseUrlProp = $reflection->getProperty('baseUrl');
        $baseUrlProp->setAccessible(true);
        $baseUrl = $baseUrlProp->getValue($namecheap);

        $params = [
            'ApiUser' => $apiUser,
            'ApiKey' => $apiKey,
            'UserName' => $apiUser,
            'Command' => 'namecheap.users.getPricing',
            'ClientIp' => $clientIp,
            'ProductType' => 'DOMAIN',
            'ProductName' => 'COM'
        ];

        $this->info("Fetching from Namecheap...");
        $response = Http::withoutVerifying()->timeout(120)->get($baseUrl, $params);
        
        $xml = $response->body();
        // find COM
        $start = strpos($xml, '<Product Name="com"');
        if ($start !== false) {
            $end = strpos($xml, '</Product>', $start) + 10;
            $this->info(substr($xml, $start, $end - $start));
        } else {
            $this->info("Could not find COM product in XML");
            file_put_contents(storage_path('logs/namecheap.xml'), $xml);
            $this->info("Dumped to storage/logs/namecheap.xml");
        }
    }
}
