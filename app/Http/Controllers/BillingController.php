<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        // Katalog Paket VPS
        $vpsPlans = [
            ['name' => 'VPS Starter', 'cpu' => '2 Core', 'ram' => '4GB', 'ssd' => '80GB', 'price' => 500000, 'type' => 'vps'],
            ['name' => 'VPS Pro', 'cpu' => '4 Core', 'ram' => '8GB', 'ssd' => '160GB', 'price' => 1200000, 'type' => 'vps', 'best_seller' => true],
            ['name' => 'VPS Enterprise', 'cpu' => '8 Core', 'ram' => '16GB', 'ssd' => '320GB', 'price' => 2500000, 'type' => 'vps'],
        ];

        // Katalog Paket Domain
        $domainPlans = [
            ['name' => 'Domain .COM', 'ext' => '.com', 'price' => 150000, 'type' => 'domain'],
            ['name' => 'Domain .ID', 'ext' => '.id', 'price' => 200000, 'type' => 'domain'],
            ['name' => 'Domain .CO.ID', 'ext' => '.co.id', 'price' => 250000, 'type' => 'domain'],
        ];

        // Katalog Paket Hosting
        $hostingPlans = [
            ['name' => 'Hosting Personal', 'space' => '5 GB', 'price' => 50000, 'type' => 'hosting'],
            ['name' => 'Hosting Bisnis', 'space' => 'Unlimited', 'price' => 150000, 'type' => 'hosting', 'best_seller' => true],
        ];

        return view('billing.index', compact('vpsPlans', 'domainPlans', 'hostingPlans'));
    }
}