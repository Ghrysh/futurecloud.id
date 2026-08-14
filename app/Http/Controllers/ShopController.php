<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * --- 1. HALAMAN KONFIGURASI (WIZARD) ---
     */
    
    // Konfigurasi Domain


    // Konfigurasi VPS
    public function configVps(Request $request)
    {
        $productName = $request->query('product_name', 'VPS Starter');
        $basePrice = $request->query('price', 500000);
        $cycle = $request->query('cycle', 'monthly');

        return view('shop.config-vps', compact('productName', 'basePrice', 'cycle'));
    }

    // Konfigurasi cPanel
    public function configCpanel(Request $request)
    {
        $productName = $request->query('product_name', 'cPanel Starter');
        $basePrice = $request->query('price', 350000);
        $cycle = $request->query('cycle', 'monthly');

        return view('shop.config-cpanel', compact('productName', 'basePrice', 'cycle'));
    }

    // Konfigurasi SaaS (INI YANG SEBELUMNYA HILANG)
    public function configSaas(Request $request)
    {
        $productName = $request->query('product_name', 'SaaS App');
        $price = $request->query('price', 0);
        $cycle = $request->query('cycle', 'monthly');
        $capacity = $request->query('capacity', ''); 

        // Ambil domain milik user yang statusnya paid/active
        $userDomains = [];
        if (Auth::check()) {
            $userDomains = \App\Models\OrderItem::whereHas('order', function($q){
                $q->where('user_id', Auth::id())->whereIn('status', ['paid', 'active']);
            })
            ->where('type', 'domain')
            ->pluck('product_name'); // Ambil nama domainnya saja
        }

        return view('shop.config-saas', compact('productName', 'price', 'cycle', 'capacity', 'userDomains'));
    }

    /**
     * --- 2. LOGIKA ADD TO CART ---
     */
    public function addToCart(Request $request)
    {
        // ... (Validasi lama tetap ada) ...
        $data = $request->validate([
            'type' => 'required|string', 
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'cycle' => 'nullable|string', 
            'domain' => 'nullable|string',
            'domain_mode' => 'nullable|string', // Tambahan parameter baru
            // ... parameter lain ...
        ]);

        $billingCycle = $request->input('cycle') ?? 'Monthly';
        $config = [];
        
        // --- LOGIKA KHUSUS SAAS + DOMAIN ---
        if ($data['type'] == 'saas') {
            
            // 1. Simpan Produk SaaS Utama
            $config['domain_connection'] = $request->input('domain');
            
            // Jika pakai domain external/existing, catat di config
            if ($request->input('domain_mode') == 'own_other') {
                $config['notes'] = "Menggunakan domain eksternal: " . $request->input('domain');
            } elseif ($request->input('domain_mode') == 'own_futurecloud') {
                $config['notes'] = "Menggunakan domain existing user.";
            }

            // Create Cart Item SaaS
            Cart::create([
                'user_id' => Auth::id(),
                'type' => 'saas',
                'product_name' => $data['product_name'],
                'price' => $data['price'], // Harga SaaS saja
                'billing_cycle' => $billingCycle,
                'configuration' => json_encode($config), 
            ]);

            // 2. JIKA BELI DOMAIN BARU -> Tambahkan Item Kedua ke Cart
            if ($request->input('domain_mode') == 'new') {
                $domainName = $request->input('domain');
                
                // Cari harga asli domain dari DB untuk keamanan (jangan percaya input user)
                $tld = substr($domainName, strrpos($domainName, '.'));
                $productDomain = \App\Models\Product::where('name', strtoupper($tld))->first();
                
                $domainPrice = $productDomain ? 
                               ($productDomain->discount_price ?? $productDomain->price) : 
                               150000; // Fallback

                // Create Cart Item Domain
                Cart::create([
                    'user_id' => Auth::id(),
                    'type' => 'domain',
                    'product_name' => 'Domain Registration (' . $domainName . ')',
                    'price' => $domainPrice,
                    'billing_cycle' => '1 Year(s)',
                    'configuration' => json_encode([
                        'domain' => $domainName,
                        'years' => 1,
                        'action' => 'register',
                        'notes' => 'Bundled with SaaS Order'
                    ]), 
                ]);
            }

        } else {
            // ... (Logika VPS/Hosting/Domain biasa tetap sama seperti kode lama) ...
            // Copy paste logika lama else {} disini
             if ($data['type'] == 'vps') {
                $config['os'] = $request->input('os');
                $billingCycle = $request->input('cycle'); 
            } 
            elseif ($data['type'] == 'domain') {
                $config['years'] = $request->input('years');
                $config['action'] = $request->input('action');
                $billingCycle = $request->input('years') . ' Year(s)';
            } 
            elseif ($data['type'] == 'hosting') {
                $config['domain_connection'] = $request->input('domain');
                $config['datacenter'] = $request->input('datacenter'); 
                $billingCycle = $request->input('cycle');
            }

            Cart::create([
                'user_id' => Auth::id(),
                'type' => $data['type'],
                'product_name' => $data['product_name'],
                'price' => $data['price'],
                'billing_cycle' => $billingCycle,
                'configuration' => json_encode($config), 
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * --- 3. HALAMAN CART ---
     */
    public function cart()
    {
        $items = Cart::where('user_id', Auth::id())->latest()->get();
        return view('cart.index', compact('items'));
    }

    public function deleteCart($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Item dihapus.');
    }

    /**
     * --- 4. CHECKOUT ---
     */
    public function checkout(Request $request)
    {
        $selectedIds = $request->input('selected_items');
        if (!$selectedIds) return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item.');

        $items = Cart::whereIn('id', $selectedIds)->where('user_id', Auth::id())->get();
        if($items->isEmpty()) return redirect()->route('cart.index')->with('error', 'Item tidak valid.');

        $subtotal = $items->sum('price');
        $tax = $subtotal * 0.11; 
        $total = $subtotal + $tax;

        return view('payment.index', compact('items', 'subtotal', 'tax', 'total'));
    }
}