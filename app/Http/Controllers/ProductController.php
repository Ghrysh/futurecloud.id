<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 1. Halaman Catalog (Semua Produk)
    public function catalog(Request $request)
    {
        // A. Ambil Kategori Domain
        $categories = Product::where('type', 'domain')
                             ->select('category')
                             ->distinct()
                             ->pluck('category')
                             ->sort();

        // B. Logic Filter Domain
        $selectedCategory = $request->input('category', 'Popular');
        $domainsQuery = Product::where('type', 'domain');

        if ($selectedCategory === 'Popular') {
            $popularTLDs = ['.COM', '.ID', '.NET', '.ORG', '.CO.ID', '.XYZ', '.IO', '.INFO', '.BIZ'];
            $domainsQuery->whereIn('name', $popularTLDs);
        } elseif ($selectedCategory !== 'all') {
            $domainsQuery->where('category', $selectedCategory);
        }

        $domains = $domainsQuery->orderBy('price', 'asc')->paginate(10)->withQueryString();

        // C. Handle AJAX Request
        if ($request->ajax()) {
            return view('partials.domain-table', compact('domains'))->render();
        }

        // D. Data Produk Lainnya
        $hostings = Product::where('type', 'hosting')->with('features')->orderBy('price', 'asc')->get();
        $vps = Product::where('type', 'vps')->with('features')->orderBy('price', 'asc')->get();

        return view('catalog', compact('domains', 'hostings', 'vps', 'categories'));
    }

    // 2. Detail VPS
    public function vpsDetail()
    {
        // Mengambil semua produk tipe 'vps' beserta fiturnya
        $vps = Product::where('type', 'vps')
                      ->with('features')
                      ->orderBy('price', 'asc')
                      ->get();

        return view('vps-detail', compact('vps'));
    }

    // 3. Detail cPanel
    public function cpanelDetail()
    {
        // Mengambil semua produk tipe 'hosting' beserta fiturnya
        // Variabel dikirim sebagai $hostings agar sesuai dengan loop di view
        $hostings = Product::where('type', 'hosting')
                           ->with('features')
                           ->orderBy('price', 'asc')
                           ->get();
        
        return view('cpanel-detail', compact('hostings'));
    }

    // 4. Detail Domain
    public function domainDetail(Request $request)
    {
        // 1. Set Default Kategori
        $currentCategory = $request->input('category', 'Popular');

        // 2. Query Utama (Untuk Tabel List)
        $query = Product::where('type', 'domain');
        if ($currentCategory !== 'all') {
            $query->where('category', $currentCategory);
        }
        $domains = $query->orderBy('price', 'asc')->paginate(10)->withQueryString();

        // --- AJAX Handler ---
        if ($request->ajax()) {
            return view('partials.domain-table', compact('domains'))->render();
        }

        // 3. Filter Kategori untuk Menu
        $categories = Product::where('type', 'domain')
                             ->select('category')
                             ->distinct()
                             ->pluck('category')
                             ->sort();

        // 4. Ambil Paket Bundling (Domain Packages)
        // Pastikan slug produk ini ada di database atau sesuaikan querynya
        $domainPackages = Product::where('type', 'domain_package') // Atau gunakan filter slug
                                 ->orWhere(function($q) {
                                     $q->where('type', 'domain')->whereIn('slug', ['basic-domain', 'premium-domain', 'business-domain']);
                                 })
                                 ->with('features')
                                 ->orderBy('price', 'asc')
                                 ->get();

        // 5. Featured Domains (Card Atas)
        $featuredDomains = Product::where('type', 'domain')
                                  ->whereIn('name', ['.COM', '.ID', '.NET', '.ORG', '.CO.ID', '.XYZ'])
                                  ->get()
                                  ->sortBy(function($item) {
                                      $order = ['.COM', '.ID', '.NET', '.ORG', '.CO.ID', '.XYZ'];
                                      return array_search($item->name, $order);
                                  });

        return view('domain-detail', compact('domains', 'categories', 'domainPackages', 'currentCategory', 'featuredDomains'));
    }
}