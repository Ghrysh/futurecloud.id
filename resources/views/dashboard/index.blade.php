@extends('layouts.client-app')

@section('title', 'Dashboard')

@section('content')
    
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>!</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm flex items-center gap-2">
            <i class="ri-calendar-line text-gray-400"></i> {{ now()->format('d M Y') }}
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
        @php
            $counts = $sidebarCounts ?? [];
            // Variabel ini dikirim dari method index() di Controller
            $cards = [
                [
                    'label' => 'Layanan Aktif', 
                    'val' => $activeServices ?? 0, 
                    'icon' => 'ri-server-line', 
                    'bg' => 'bg-blue-50', 
                    'text' => 'text-blue-600',
                    'link' => route('client.products') // Pastikan route ini ada
                ],
                [
                    'label' => 'Domain Aktif', 
                    'val' => $totalDomains ?? 0, 
                    'icon' => 'ri-global-line', 
                    'bg' => 'bg-green-50', 
                    'text' => 'text-green-600',
                    'link' => route('client.domain') // Pastikan route ini ada
                ],
                [
                    'label' => 'Tagihan Unpaid', 
                    'val' => $unpaidInvoices ?? 0, 
                    'icon' => 'ri-file-warning-line', 
                    'bg' => 'bg-yellow-50', 
                    'text' => 'text-yellow-600',
                    'link' => route('client.invoices')
                ],
                [
                    'label' => 'Tiket Support', 
                    'val' => $openTickets ?? 0, 
                    'icon' => 'ri-customer-service-2-line', 
                    'bg' => 'bg-red-50', 
                    'text' => 'text-red-600',
                    'link' => '#' // Ganti route ticket jika ada
                ],
            ];
        @endphp

        @foreach($cards as $c)
        <a href="{{ $c['link'] }}" class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-28 md:h-32 hover:shadow-md hover:border-blue-200 transition group relative overflow-hidden">
            <div class="flex justify-between items-start z-10">
                <span class="text-2xl md:text-4xl font-bold text-gray-800">{{ $c['val'] }}</span>
                <div class="p-2 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} group-hover:scale-110 transition-transform">
                    <i class="{{ $c['icon'] }} text-lg md:text-xl"></i>
                </div>
            </div>
            <span class="text-xs md:text-sm text-gray-500 font-medium z-10">{{ $c['label'] }}</span>
            <i class="{{ $c['icon'] }} absolute -bottom-4 -right-4 text-6xl opacity-5 text-gray-400 group-hover:opacity-10 transition"></i>
        </a>
        @endforeach
    </div>

    <!-- MAIN GRID CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        
        <!-- KOLOM KIRI: INVOICES & LAYANAN -->
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Section: Tagihan Terbaru --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 md:p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-bill-line text-gray-400"></i> Tagihan Terbaru
                    </h3>
                    <a href="{{ route('client.invoices') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                        Lihat Semua
                    </a>
                </div>
                
                {{-- Ambil 3 Invoice Terakhir dari DB --}}
                @php
                    $latestInvoices = \App\Models\Order::where('user_id', Auth::id())->latest()->take(3)->get();
                @endphp

                @if($latestInvoices->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($latestInvoices as $inv)
                        <div class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-mono text-xs text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded">{{ $inv->invoice_number }}</span>
                                    <span class="text-xs text-gray-400">{{ $inv->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</div>
                            </div>
                            <div>
                                @if(in_array(strtolower($inv->status), ['paid', 'active']))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                                @elseif($inv->status == 'cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Batal</span>
                                @else
                                    <a href="{{ route('client.invoices') }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">
                                        Bayar
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="p-10 text-center">
                        <div class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ri-checkbox-circle-line text-3xl"></i>
                        </div>
                        <h4 class="text-gray-900 font-semibold mb-1">Tidak Ada Tagihan</h4>
                        <p class="text-sm text-gray-500">Hebat! Anda tidak memiliki tagihan yang perlu dibayar.</p>
                    </div>
                @endif
            </div>

            {{-- Section: Layanan Aktif --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-server-line text-gray-400"></i> Layanan Aktif
                    </h3>
                </div>
                
                {{-- Ambil 3 Layanan Aktif Terakhir --}}
                @php
                    $latestServices = \App\Models\OrderItem::whereHas('order', function($q) {
                        $q->where('user_id', Auth::id())->whereIn('status', ['paid', 'active']);
                    })->latest()->take(3)->get();
                @endphp

                @if($latestServices->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($latestServices as $svc)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-lg bg-blue-50 text-blue-600">
                                    @if($svc->type == 'vps') <i class="ri-server-line"></i>
                                    @elseif($svc->type == 'domain') <i class="ri-global-line"></i>
                                    @else <i class="ri-hard-drive-2-line"></i> @endif
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-800">{{ $svc->product_name }}</h4>
                                    <span class="text-xs text-gray-500 capitalize">{{ $svc->type }} &bull; {{ $svc->billing_cycle }}</span>
                                </div>
                            </div>
                            <a href="{{ route('client.services.show', $svc->id) }}" class="text-gray-400 hover:text-blue-600 transition">
                                <i class="ri-settings-3-line text-xl"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                        <a href="{{ route('client.products') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua Layanan</a>
                    </div>
                @else
                    {{-- Empty State Layanan --}}
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ri-inbox-archive-line text-3xl"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Anda belum memiliki layanan aktif.</p>
                        <a href="{{ url('/catalog') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow-sm shadow-blue-200 transition inline-flex items-center gap-2">
                            <i class="ri-shopping-cart-2-line"></i> Order Layanan Baru
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- KOLOM KANAN: SIDE WIDGETS -->
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Widget: Network Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <h3 class="font-bold text-gray-800 text-sm">System Status</h3>
                </div>
                <div class="p-4">
                    <div class="text-xs text-gray-600 space-y-3">
                        <div class="flex justify-between items-center">
                            <span>Network ID (IIX)</span>
                            <span class="text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded">Operational</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Cloud Nodes SG</span>
                            <span class="text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded">Operational</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Client Area</span>
                            <span class="text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded">Operational</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-50 text-xs text-gray-400 flex items-center gap-1">
                        <i class="ri-time-line"></i> Last check: {{ now()->format('H:i') }}
                    </div>
                </div>
            </div>

            {{-- Widget: Panduan --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 text-sm">Panduan Cepat</h3>
                </div>
                <ul class="divide-y divide-gray-50 text-sm">
                    @php
                        $guides = [
                            ['title' => 'Cara Login cPanel', 'icon' => 'ri-settings-3-line'],
                            ['title' => 'Setting DNS Domain', 'icon' => 'ri-earth-line'],
                            ['title' => 'Instalasi WordPress', 'icon' => 'ri-wordpress-fill'],
                        ];
                    @endphp
                    @foreach($guides as $guide)
                    <li>
                        <a href="#" class="block p-3 hover:bg-blue-50 transition group flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center group-hover:bg-blue-100 group-hover:text-blue-600 transition">
                                <i class="{{ $guide['icon'] }}"></i>
                            </div>
                            <span class="text-gray-600 group-hover:text-blue-700 font-medium">{{ $guide['title'] }}</span>
                            <i class="ri-arrow-right-s-line ml-auto text-gray-300 group-hover:text-blue-400"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection