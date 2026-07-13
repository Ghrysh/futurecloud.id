<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;      // Model Invoice/Order Baru
use App\Models\OrderItem;  // Model Layanan/Subscription Baru
use Illuminate\Routing\Controllers\HasMiddleware;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientAreaController extends Controller implements HasMiddleware
{
    /**
     * Download Invoice PDF
     */
    public function downloadInvoice($id)
    {
        // Cari Order berdasarkan ID dan pastikan milik user yang login
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $user = Auth::user();

        // Load view PDF. Pastikan file resources/views/pdf/invoice.blade.php sudah disesuaikan dengan variabel $order
        // Kita passing variable 'invoice' agar view lama tetap jalan (alias $order)
        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $order, 'user' => $user]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Invoice-' . $order->invoice_number . '.pdf');
    }
    
    /**
     * Middleware Static (Laravel 11 Style)
     * Menghitung jumlah layanan untuk sidebar (Counter Badge)
     */
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                $userId = Auth::id();

                if ($userId) {
                    // Ambil semua item yang ordernya milik user ini
                    $items = OrderItem::whereHas('order', function($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })->get();

                    $counts = [
                        'products'  => $items->count(),
                        'domain'    => $items->where('type', 'domain')->count(),
                        'hosting'   => $items->where('type', 'hosting')->count(),
                        'email'     => $items->where('type', 'email')->count(),
                        'vps'       => $items->where('type', 'vps')->count(),
                        'saas'      => $items->filter(function($item) { return $item->type == 'saas' && stripos($item->product_name, 'Plugin') === false; })->count(),
                        'plugin'    => $items->filter(function($item) { return $item->type == 'saas' && stripos($item->product_name, 'Plugin') !== false; })->count(),
                        'ssl'       => $items->where('type', 'ssl')->count(),
                        'aws'       => $items->where('type', 'aws')->count(),
                        'license'   => $items->where('type', 'license')->count(),
                        'others'    => $items->where('type', 'others')->count(),
                    ];

                    View::share('sidebarCounts', $counts);
                }

                return $next($request);
            }
        ];
    }

    // --- HALAMAN DASHBOARD UTAMA ---
    public function index()
    {
        $userId = Auth::id();
        
        // Hitung Layanan Aktif (Status Order = Paid)
        $activeServices = OrderItem::whereHas('order', function($q) use ($userId) {
            $q->where('user_id', $userId)->whereIn('status', ['paid', 'active']);
        })->where('type', '!=', 'domain')->count();

        // Hitung Domain Aktif
        $totalDomains = OrderItem::whereHas('order', function($q) use ($userId) {
            $q->where('user_id', $userId)->whereIn('status', ['paid', 'active']);
        })->where('type', 'domain')->count();

        // Hitung Invoice Belum Bayar
        $unpaidInvoices = Order::where('user_id', $userId)->where('status', 'pending')->count();
        
        $openTickets = 0; // Placeholder tiket

        return view('dashboard.index', compact('activeServices', 'totalDomains', 'unpaidInvoices', 'openTickets'));
    }

    // --- HALAMAN LIST INVOICE ---
    public function invoices()
    {
        \App\Models\Order::cleanUpExpired();
        
        $invoices = Order::where('user_id', Auth::id())
                         ->with('items') 
                         ->latest()
                         ->get();
                         
        return view('dashboard.invoices', compact('invoices'));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    /**
     * MENAMPILKAN LIST PRODUK (DENGAN SEARCH, FILTER, & PAGINATION)
     */
    public function showProduct(Request $request, $type)
    {
        // 1. Judul Halaman
        $titles = [
            'products'  => 'Semua Produk',
            'domain'    => 'List Domain',
            'hosting'   => 'Web Hosting',
            'email'     => 'Email Corporate',
            'vps'       => 'Virtual Private Server',
            'saas'      => 'Aplikasi SaaS',
            'dedicated' => 'Dedicated Server',
            'ssl'       => 'SSL Certificates',
            'aws'       => 'Amazon Web Services',
            'license'   => 'Lisensi Software',
            'others'    => 'Layanan Lainnya'
        ];
        
        $title = $titles[$type] ?? 'Layanan';

        // 2. Query Dasar (OrderItem milik User)
        $query = OrderItem::whereHas('order', function($q) {
            $q->where('user_id', Auth::id());
        });

        // Filter Type
        if ($type !== 'products') {
            $query->where('type', $type);
        }

        // 3. Fitur Search (Update: Cari di product_name ATAU JSON configuration)
        if ($request->has('search') && $request->search != null) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('product_name', 'like', "%{$keyword}%")
                  ->orWhere('configuration', 'like', "%{$keyword}%"); // Cari IP/Domain di JSON
            });
        }

        // 4. Fitur Filter Status (Cek Status Parent Order)
        if ($request->has('status') && $request->status != 'all' && $request->status != null) {
            $status = $request->status;
            $query->whereHas('order', function($q) use ($status) {
                // Mapping status UI ke Database
                if ($status == 'active') $q->whereIn('status', ['paid', 'active']);
                else $q->where('status', $status);
            });
        }

        // 5. Pagination
        $perPage = $request->input('per_page', 10);

        // Eager load 'order' agar tidak query berulang di view
        $services = $query->with('order')
                          ->latest()
                          ->paginate($perPage)
                          ->withQueryString(); 

        // --- AJAX Handler untuk Live Search ---
        if ($request->ajax()) {
            return view('dashboard.partials.services-list', compact('services'))->render();
        }
        
        return view('dashboard.services', compact('title', 'type', 'services'));
    }

    /**
     * HALAMAN MANAGE (DETAIL PRODUK)
     */
    public function manage($id)
    {
        // Cari produk (OrderItem) berdasarkan ID
        $service = OrderItem::whereHas('order', function($q) {
                                $q->where('user_id', Auth::id());
                            })
                            ->findOrFail($id);

        $title = "Kelola Layanan - " . $service->product_name;

        // View ini akan menampilkan detail Username/Password/IP dari kolom configuration
        return view('dashboard.manage', compact('title', 'service'));
    }

    /**
     * HALAMAN PLUGIN (KHUSUS PLUGIN)
     */
    public function plugins()
    {
        $plugins = OrderItem::whereHas('order', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('type', 'saas')
        ->where('product_name', 'like', '%Plugin%')
        ->with('order')
        ->latest()
        ->get();

        foreach ($plugins as $plugin) {
            $config = $plugin->configuration ?? [];
            if(is_string($config)) {
                $config = json_decode($config, true) ?? [];
            }
            $licenseKey = $config['license_key'] ?? null;
            
            if ($licenseKey) {
                // Gunakan config lokal sebagai ganti query database eksternal
                $plugin->plugin_data = (object)[
                    'status' => $config['status'] ?? 'active',
                    'bot_name' => $config['bot_name'] ?? null,
                    'bot_color' => $config['bot_color'] ?? null,
                ];
            }
        }

        return view('dashboard.plugin', compact('plugins'));
    }

    // New method for managing specific plugins UI (Tabs layout)
    public function pluginManage()
    {
        $plugins = OrderItem::whereHas('order', function($q) {
            $q->where('user_id', Auth::id())
              ->where('status', 'paid');
        })
        ->where('product_name', 'like', '%Plugin%')
        ->with('order')
        ->latest()
        ->get();

        // Load plugin data from local config
        foreach ($plugins as $plugin) {
            $config = $plugin->configuration ?? [];
            if(is_string($config)) {
                $config = json_decode($config, true) ?? [];
            }
            $licenseKey = $config['license_key'] ?? null;
            
            if ($licenseKey) {
                // Gunakan config lokal sebagai ganti query database eksternal
                $plugin->plugin_data = (object)[
                    'status' => $config['status'] ?? 'active',
                    'bot_name' => $config['bot_name'] ?? null,
                    'bot_color' => $config['bot_color'] ?? null,
                ];
            }
        }

        return view('dashboard.plugin-manage', compact('plugins'));
    }

    public function updateChatbotSettings(Request $request, $id)
    {
        $request->validate([
            'bot_name' => 'required|string|max:255',
            'bot_color' => 'required|string|max:7',
        ]);

        $plugin = OrderItem::whereHas('order', function($q) {
            $q->where('user_id', Auth::id())->where('status', 'paid');
        })->where('id', $id)->firstOrFail();

        $config = $plugin->configuration ?? [];
        if(is_string($config)) {
            $config = json_decode($config, true) ?? [];
        }
        $licenseKey = $config['license_key'] ?? null;

        if ($licenseKey) {
            // Tentukan URL API
            $apiUrl = env('CHATBOT_API_URL', 'http://localhost:8081');

            try {
                // Sinkronisasi ke Chatbot API
                \Illuminate\Support\Facades\Http::post($apiUrl . '/api/v1/license/config', [
                    'license_key' => $licenseKey,
                    'bot_name' => $request->bot_name,
                    'bot_color' => $request->bot_color,
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Gagal sinkronisasi config chatbot {$licenseKey}: " . $e->getMessage());
                // Lanjut saja agar lokal tersimpan
            }
            
            // Simpan lokal di configuration
            $config['bot_name'] = $request->bot_name;
            $config['bot_color'] = $request->bot_color;
            $plugin->configuration = json_encode($config);
            $plugin->save();
            
            return back()->with('success', 'Pengaturan Chatbot berhasil disimpan.');
        }

        return back()->with('error', 'Lisensi tidak ditemukan.');
    }
}