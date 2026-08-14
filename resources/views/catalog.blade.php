@extends('layouts.landing')

@section('title', 'Katalog Produk & Layanan')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }
        
        /* Smooth category transition */
        .cat-btn { transition: all 0.3s ease; }
        .cat-btn.active { background-color: #2563EB; color: white; border-color: #2563EB; }
        
        /* Billing Switcher */
        .billing-btn { transition: all 0.3s ease; }
        .billing-btn.active { background-color: #2563EB; color: white; border-color: #2563EB; }

        /* Card Hover */
        .catalog-card { transition: all 0.3s ease; }
        .catalog-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    </style>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-20 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/catalog-hero.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/90"></div>
        </div>

        <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none z-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-cyan-500 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-5xl mx-auto relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wider mb-4 uppercase">One Stop Solution</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Katalog Lengkap<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Layanan Digital</span>
            </h1>

            <p class="text-blue-100 text-lg mb-8 font-light max-w-2xl mx-auto leading-relaxed px-4">
                Semua kebutuhan infrastruktur digital Anda ada di sini. Pilih layanan terbaik untuk pertumbuhan bisnis Anda.
            </p>

            {{-- Trust Badges --}}
            <div class="flex flex-wrap justify-center gap-6 mb-10 text-sm font-medium text-blue-200">
                <div class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-fill text-green-400 text-lg"></i> <span>Aktivasi Instan</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="ri-shield-check-fill text-green-400 text-lg"></i> <span>Uptime 99.9%</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="ri-customer-service-2-fill text-green-400 text-lg"></i> <span>Support 24/7</span>
                </div>
            </div>

            {{-- Anchor Navigation --}}
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <a href="#domain" class="px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full text-sm font-semibold hover:bg-blue-600 hover:border-transparent transition flex items-center gap-2">
                    <i class="ri-global-line"></i> Domain
                </a>
                <a href="#hosting" class="px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full text-sm font-semibold hover:bg-blue-600 hover:border-transparent transition flex items-center gap-2">
                    <i class="ri-hard-drive-2-line"></i> Hosting
                </a>
                <a href="#vps" class="px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full text-sm font-semibold hover:bg-blue-600 hover:border-transparent transition flex items-center gap-2">
                    <i class="ri-server-line"></i> VPS
                </a>
                <a href="#saas" class="px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full text-sm font-semibold hover:bg-blue-600 hover:border-transparent transition flex items-center gap-2">
                    <i class="ri-apps-line"></i> SaaS
                </a>
            </div>
        </div>
    </section>

    {{-- DOMAIN SECTION (Pricing Table Style) --}}
    <section id="domain" class="py-20 px-4 bg-white scroll-mt-20">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Daftar Harga Domain</h2>
                <p class="text-gray-600 text-base max-w-2xl mx-auto">
                    Cek biaya registrasi, perpanjangan, dan transfer untuk semua ekstensi domain yang tersedia di FutureCloud.id.
                </p>
            </div>

            {{-- CATEGORY FILTER --}}
            <div class="mb-8 relative">
                <div class="flex overflow-x-auto gap-2 pb-4 scrollbar-hide px-4 justify-start" id="category-filter">
                    <button onclick="filterCategory('Popular')" class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-blue-600 bg-blue-600 text-white active flex-shrink-0" data-cat="Popular">Populer 🔥</button>
                    <button onclick="filterCategory('all')" class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 hover:bg-gray-100 flex-shrink-0" data-cat="all">Semua</button>
                    @foreach ($categories as $cat)
                        @if($cat != 'Popular') 
                        <button onclick="filterCategory('{{ $cat }}')" class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 hover:bg-gray-100 flex-shrink-0" data-cat="{{ $cat }}">{{ $cat }}</button>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- TABLE CONTAINER --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden relative min-h-[300px]">
                <div id="table-loading" class="absolute inset-0 bg-white/90 z-20 flex items-center justify-center hidden backdrop-blur-sm">
                    <div class="flex flex-col items-center">
                        <i class="ri-loader-4-line text-4xl text-blue-600 animate-spin"></i>
                        <span class="text-sm font-bold text-gray-600 mt-2">Memuat Data...</span>
                    </div>
                </div>
                <div id="table-content">
                    @include('partials.domain-table', ['domains' => $domains])
                </div>
            </div>
        </div>
    </section>

    {{-- HOSTING SECTION --}}
    <section id="hosting" class="w-full py-20 px-0 md:px-4 bg-gray-50 scroll-mt-16">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8 px-4">
                <h2 class="text-3xl font-extrabold text-gray-900">Shared Hosting</h2>
                <p class="text-gray-500 mt-2">Paket Shared Hosting terbaik untuk website personal hingga bisnis.</p>
            </div>

            {{-- BILLING SWITCHER HOSTING --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10 px-4">
                <button class="billing-btn active px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="monthly" onclick="updateCatalogPricing('hosting', 'monthly')">Bulanan</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="annually" onclick="updateCatalogPricing('hosting', 'annually')">1 Tahun</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="biennially" onclick="updateCatalogPricing('hosting', 'biennially')">2 Tahun</button>
            </div>

            <div class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 px-6 pb-12 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible items-start">
                @foreach ($hostings as $plan)
                    @php
                        // Default Monthly PHP Render
                        $cycleKey = 'monthly';
                        $config = $plan->discount_config[$cycleKey] ?? [];
                        
                        $basePrice = $plan->price;
                        $normalPrice = $basePrice; 
                        if (!empty($config['custom_price']) && $config['custom_price'] > 0) {
                            $normalPrice = (float) $config['custom_price'];
                        }

                        $finalPrice = $normalPrice;
                        $promoLabel = $config['label'] ?? '';
                        $promoInfo  = '';
                        $isPromo    = false;
                        $type = $config['type'] ?? 'none';
                        $val  = $config['value'] ?? 0;

                        if ($type == 'percent' && $val > 0) {
                            $discountAmount = $normalPrice * ($val / 100);
                            $finalPrice = $normalPrice - $discountAmount;
                            $promoInfo = "Diskon $val%";
                        } elseif ($type == 'fixed' && $val > 0) {
                            $finalPrice = (float) $val;
                            $promoInfo = "Harga Spesial";
                        }
                        if ($finalPrice < $normalPrice) $isPromo = true;
                    @endphp

                    <div class="catalog-card hosting-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full hover:shadow-2xl 
                        {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($plan->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200') }}"
                        
                        data-base-price="{{ $plan->price }}" 
                        data-plan-name="{{ $plan->name }}"
                        data-tag="{{ $plan->tag ?? '' }}"
                        data-discount-config='{{ json_encode($plan->discount_config ?? []) }}'>

                        {{-- BADGE --}}
                        <span class="card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
                             {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($plan->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                            {{ $isPromo ? 'PROMO' : ($plan->tag ?? '') }}
                        </span>

                        <div class="flex-1">
                            <h4 class="font-bold text-2xl text-center text-gray-900 border-b border-gray-50 pb-4 mb-4">{{ $plan->name }}</h4>
                            
                            {{-- PRICE AREA --}}
                            <div class="price-container flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                <div class="promo-label-container {{ $isPromo && $promoLabel ? '' : 'hidden' }}">
                                    <span class="promo-label text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                </div>
                                <div class="strike-container flex items-center justify-center gap-2 text-xs {{ $isPromo ? '' : 'hidden' }}">
                                    <span class="strike-price text-gray-400 line-through decoration-red-300">
                                        Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-info text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                        {{ $promoInfo }}
                                    </span>
                                </div>
                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span class="price-text text-4xl font-extrabold tracking-tight leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="cycle-label text-sm font-semibold text-gray-400">/bln</span>
                                </div>
                            </div>

                            <ul class="space-y-3 text-sm text-gray-700">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1 bg-green-100 rounded-full shrink-0"><i class="ri-check-line text-green-600 text-xs font-bold"></i></div>
                                        <span>{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('order.config.cpanel', ['product_name' => $plan->name, 'price' => $finalPrice]) }}&cycle=monthly" 
                           class="order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 
                           {{ $isPromo ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                            Pilih Paket
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- VPS SECTION --}}
    <section id="vps" class="w-full py-20 px-0 md:px-4 bg-white scroll-mt-16">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8 px-4">
                <h2 class="text-3xl font-extrabold text-gray-900">VPS Hosting</h2>
                <p class="text-gray-500 mt-2">Performa tinggi dengan dedicated resource dan akses root penuh.</p>
            </div>

            {{-- BILLING SWITCHER VPS --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10 px-4">
                <button class="billing-btn active px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="monthly" onclick="updateCatalogPricing('vps', 'monthly')">Bulanan</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="quarterly" onclick="updateCatalogPricing('vps', 'quarterly')">3 Bulan</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100" data-cycle="annually" onclick="updateCatalogPricing('vps', 'annually')">1 Tahun</button>
            </div>

            <div class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 px-6 pb-12 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible items-start">
                @foreach ($vps as $plan)
                    @php
                        // PHP Logic Default Monthly
                        $cycleKey = 'monthly';
                        $config = $plan->discount_config[$cycleKey] ?? [];
                        
                        $basePrice = $plan->price;
                        $normalPrice = $basePrice; 
                        if (!empty($config['custom_price']) && $config['custom_price'] > 0) {
                            $normalPrice = (float) $config['custom_price'];
                        }

                        $finalPrice = $normalPrice;
                        $promoLabel = $config['label'] ?? '';
                        $promoInfo  = '';
                        $isPromo    = false;
                        $type = $config['type'] ?? 'none';
                        $val  = $config['value'] ?? 0;

                        if ($type == 'percent' && $val > 0) {
                            $discountAmount = $normalPrice * ($val / 100);
                            $finalPrice = $normalPrice - $discountAmount;
                            $promoInfo = "Diskon $val%";
                        } elseif ($type == 'fixed' && $val > 0) {
                            $finalPrice = (float) $val;
                            $promoInfo = "Harga Spesial";
                        }
                        if ($finalPrice < $normalPrice) $isPromo = true;
                    @endphp

                    <div class="catalog-card vps-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full hover:shadow-2xl 
                        {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($plan->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200') }}"
                        
                        data-base-price="{{ $plan->price }}" 
                        data-plan-name="{{ $plan->name }}"
                        data-tag="{{ $plan->tag ?? '' }}"
                        data-discount-config='{{ json_encode($plan->discount_config ?? []) }}'>

                        {{-- BADGE --}}
                        <span class="card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
                             {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($plan->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                            {{ $isPromo ? 'PROMO' : ($plan->tag ?? '') }}
                        </span>

                        <div class="flex-1">
                            <h4 class="font-bold text-2xl text-center text-gray-900 border-b border-gray-50 pb-4 mb-4">{{ $plan->name }}</h4>
                            
                            {{-- PRICE AREA --}}
                            <div class="price-container flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                <div class="promo-label-container {{ $isPromo && $promoLabel ? '' : 'hidden' }}">
                                    <span class="promo-label text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                </div>
                                <div class="strike-container flex items-center justify-center gap-2 text-xs {{ $isPromo ? '' : 'hidden' }}">
                                    <span class="strike-price text-gray-400 line-through decoration-red-300">
                                        Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-info text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                        {{ $promoInfo }}
                                    </span>
                                </div>
                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span class="price-text text-4xl font-extrabold tracking-tight leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="cycle-label text-sm font-semibold text-gray-400">/bln</span>
                                </div>
                            </div>

                            <ul class="space-y-3 text-sm text-gray-700">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1 bg-green-100 rounded-full shrink-0"><i class="ri-check-line text-green-600 text-xs font-bold"></i></div>
                                        <span>{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('order.config.vps', ['product_name' => $plan->name, 'price' => $finalPrice]) }}&cycle=monthly" 
                           class="order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 
                           {{ $isPromo ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                            Pilih Paket
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SAAS SECTION --}}
    <section id="saas" class="w-full py-20 px-4 bg-gray-900 text-white scroll-mt-16">
        <div class="max-w-5xl mx-auto text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wider mb-4 uppercase">Software Solutions</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mb-6">SaaS Marketplace</h2>
            <p class="text-blue-200 mb-10 text-lg max-w-2xl mx-auto">
                Temukan aplikasi siap pakai untuk mempercepat operasional bisnis Anda. Mulai dari HRIS, Accounting, hingga CRM.
            </p>
            <a href="{{ route('saas.detail') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-500 transition shadow-lg shadow-blue-900/50">
                <span>Jelajahi Marketplace</span>
                <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    </section>

    {{-- SEO / INFORMATIVE SECTION --}}
    <section class="w-full py-20 px-4 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Mengapa Memilih Layanan FutureCloud?</h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <i class="ri-rocket-line text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Performa Super Cepat</h4>
                            <p class="text-gray-600 mt-1">Server kami dioptimalkan dengan teknologi NVMe SSD dan LiteSpeed untuk menjamin kecepatan loading website Anda maksimal.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <i class="ri-lock-2-line text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Keamanan Tingkat Tinggi</h4>
                            <p class="text-gray-600 mt-1">Dilengkapi dengan Imunify360, SSL Gratis, dan proteksi Anti-DDoS untuk menjaga data Anda dari ancaman siber.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <i class="ri-wallet-3-line text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Harga Transparan</h4>
                            <p class="text-gray-600 mt-1">Tidak ada biaya tersembunyi. Dapatkan fitur premium dengan harga yang sangat terjangkau untuk semua kalangan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Butuh Bantuan Memilih Paket?</h3>
                <p class="text-gray-600 mb-6">
                    Tim ahli kami siap membantu Anda menentukan layanan yang paling pas untuk skala dan kebutuhan bisnis Anda saat ini.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-2 text-gray-700">
                        <i class="ri-check-line text-green-500"></i> Konsultasi Infrastruktur Gratis
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <i class="ri-check-line text-green-500"></i> Bantuan Migrasi Website
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <i class="ri-check-line text-green-500"></i> Rekomendasi Skalabilitas
                    </li>
                </ul>
                <a href="{{ route('contact') }}" class="block w-full py-3 text-center bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition">
                    Hubungi Tim Support
                </a>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    // FILTER DOMAIN
    window.filterCategory = function(category) {
        document.querySelectorAll('.cat-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
            btn.classList.add('border-gray-300', 'text-gray-600', 'hover:bg-gray-100');
        });
        const activeBtn = document.querySelector(`.cat-btn[data-cat="${category}"]`);
        if(activeBtn) {
            activeBtn.classList.remove('border-gray-300', 'text-gray-600', 'hover:bg-gray-100');
            activeBtn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');
        }
        document.getElementById('table-loading').classList.remove('hidden');
        const url = new URL("{{ route('catalog') }}");
        url.searchParams.set('category', category);
        url.searchParams.set('page', 1);
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.text())
        .then(html => {
            document.getElementById('table-content').innerHTML = html;
            attachTableListeners();
        })
        .finally(() => document.getElementById('table-loading').classList.add('hidden'));
    };

    function attachTableListeners() {
        const links = document.querySelectorAll('#ajax-pagination-links a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                document.getElementById('table-loading').classList.remove('hidden');
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('table-content').innerHTML = html;
                    attachTableListeners();
                })
                .finally(() => document.getElementById('table-loading').classList.add('hidden'));
            });
        });
    }

    // UPDATE PRICING (SHARED FOR HOSTING & VPS)
    window.updateCatalogPricing = function(sectionId, cycle) {
        // 1. Update Button State di Section Terkait
        const section = document.getElementById(sectionId);
        section.querySelectorAll('.billing-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
            btn.classList.add('border-gray-300', 'text-gray-600');
            if (btn.getAttribute('data-cycle') === cycle) {
                btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                btn.classList.remove('border-gray-300', 'text-gray-600', 'hover:bg-gray-100');
            }
        });

        // 2. Loop & Update Cards di Section Terkait
        const cards = section.querySelectorAll('.catalog-card');
        cards.forEach(card => {
            try {
                const basePriceMonthly = parseFloat(card.getAttribute('data-base-price'));
                const planName = card.getAttribute('data-plan-name');
                const planTag = card.getAttribute('data-tag');
                
                let discountConfig = {};
                try { discountConfig = JSON.parse(card.getAttribute('data-discount-config')); } catch(e) {}

                // Elemen
                const badgeEl = card.querySelector('.card-badge');
                const promoLabelContainer = card.querySelector('.promo-label-container');
                const promoLabelEl = card.querySelector('.promo-label');
                const strikeContainer = card.querySelector('.strike-container');
                const strikePriceEl = card.querySelector('.strike-price');
                const discountInfoEl = card.querySelector('.discount-info');
                const priceTextEl = card.querySelector('.price-text');
                const cycleLabelEl = card.querySelector('.cycle-label');
                const btnEl = card.querySelector('.order-btn');

                let months = 1;
                let cycleKey = 'monthly';
                let cycleText = '/bln';

                if (cycle === 'annually') { months = 12; cycleKey = 'annually'; cycleText = '/thn'; }
                else if (cycle === 'quarterly') { months = 3; cycleKey = 'quarterly'; cycleText = '/3 bln'; }
                else if (cycle === 'biennially') { months = 24; cycleKey = 'biennially'; cycleText = '/2 thn'; }
                else { months = 1; cycleKey = 'monthly'; cycleText = '/bln'; }

                // --- 1. HARGA NORMAL ---
                let config = discountConfig[cycleKey] || {};
                let totalNormalPrice = 0;
                
                if (config.custom_price && parseFloat(config.custom_price) > 0) {
                    totalNormalPrice = parseFloat(config.custom_price);
                } else {
                    totalNormalPrice = basePriceMonthly * months;
                }

                // --- 2. DISKON ---
                let finalPrice = totalNormalPrice;
                let isPromo = false;
                let eventLabel = '';
                let promoTypeInfo = '';

                if (config.type && config.type !== 'none') {
                    if (config.type === 'percent' && parseFloat(config.value) > 0) {
                        let discountAmount = totalNormalPrice * (parseFloat(config.value) / 100);
                        finalPrice = totalNormalPrice - discountAmount;
                        promoTypeInfo = `Diskon ${config.value}%`;
                    } else if (config.type === 'fixed' && parseFloat(config.value) > 0) {
                        finalPrice = parseFloat(config.value);
                        promoTypeInfo = "Harga Spesial";
                    }
                    eventLabel = config.label || '';
                    if(finalPrice < totalNormalPrice) isPromo = true;
                }

                // --- 3. UI UPDATE ---
                // Reset Base Classes
                card.className = `catalog-card ${sectionId}-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full hover:shadow-2xl`;

                if(isPromo) {
                    card.classList.add('border-2', 'border-red-500', 'shadow-red-50');
                    if(badgeEl) {
                        badgeEl.innerText = 'PROMO';
                        badgeEl.className = 'card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-red-600 to-red-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white';
                        badgeEl.classList.remove('hidden');
                    }
                    if(eventLabel) {
                        promoLabelEl.innerText = eventLabel;
                        promoLabelContainer.classList.remove('hidden');
                    } else {
                        promoLabelContainer.classList.add('hidden');
                    }
                    strikePriceEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalNormalPrice);
                    discountInfoEl.innerText = promoTypeInfo;
                    strikeContainer.classList.remove('hidden');
                    
                    priceTextEl.className = 'price-text text-4xl font-extrabold tracking-tight leading-none text-red-600';
                    btnEl.className = 'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-red-600 text-white hover:bg-red-700 shadow-red-200';
                } else {
                    if(planTag) {
                        card.classList.add('border-2', 'border-blue-500', 'shadow-blue-50');
                        if(badgeEl) {
                            badgeEl.innerText = planTag;
                            badgeEl.className = 'card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white';
                            badgeEl.classList.remove('hidden');
                        }
                    } else {
                        card.classList.add('border-2', 'border-gray-200');
                        if(badgeEl) badgeEl.classList.add('hidden');
                    }
                    promoLabelContainer.classList.add('hidden');
                    strikeContainer.classList.add('hidden');
                    
                    priceTextEl.className = 'price-text text-4xl font-extrabold tracking-tight leading-none text-blue-600';
                    btnEl.className = 'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200';
                }

                priceTextEl.innerText = new Intl.NumberFormat('id-ID').format(finalPrice);
                cycleLabelEl.innerText = cycleText;

                // Update URL Order
                let orderRoute = (sectionId === 'vps') ? 'vps' : 'cpanel';
                const baseUrl = `/order/config/${orderRoute}`; // Sesuaikan dengan route Anda
                btnEl.href = `${baseUrl}?product_name=${encodeURIComponent(planName)}&price=${finalPrice}&cycle=${cycle}`;

            } catch (error) {
                console.error("Error updating catalog card", error);
            }
        });
    }
</script>
@endsection