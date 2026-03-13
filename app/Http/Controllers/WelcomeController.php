<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSetting;
use App\Models\Product;
use App\Models\SaasProduct;

class WelcomeController extends Controller
{
    public function index()
    {
        $hero = HeroSetting::first();
        
        // 1. DOMAIN (Logic Tetap)
        $domains = Product::where('type', 'domain')
            ->whereIn('name', ['.COM', '.ID', '.NET'])
            ->with('features')
            ->get()
            ->sortBy(function($item) {
                return array_search($item->name, ['.COM', '.ID', '.NET']);
            });

        // 2. HOSTING (Diurutkan berdasarkan harga termurah)
        $hostings = Product::where('type', 'hosting')
            ->orderBy('price', 'asc') // <--- TAMBAHAN: Urutkan harga terendah ke tinggi
            ->take(3)
            ->get();

        // 3. VPS (Diurutkan berdasarkan harga termurah)
        $vps = Product::where('type', 'vps')
            ->orderBy('price', 'asc') // <--- TAMBAHAN: Urutkan harga terendah ke tinggi
            ->take(3)
            ->get();
        
        // 4. SAAS (Logic Tetap)
        $saas = SaasProduct::whereIn('slug', ['business-email', 'fast-vpn', 'ssl-certificates'])
            ->where('status', 'approved')
            ->get()
            ->sortBy(function($item) {
                return array_search($item->slug, ['business-email', 'ssl-certificates', 'fast-vpn']);
            });

        return view('welcome', compact('hero', 'domains', 'hostings', 'vps', 'saas'));
    }
}