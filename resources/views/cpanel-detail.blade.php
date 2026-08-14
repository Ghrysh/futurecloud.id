@extends('layouts.landing')

@section('title', 'Shared Hosting - FutureCloud.id')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        i { display: inline-block !important; visibility: visible !important; }
        
        /* Toggle Switcher */
        .billing-btn { transition: all 0.3s ease; }
        .billing-btn.active { background-color: #2563EB; color: white; border-color: #2563EB; }
        
        /* Accordion */
        .accordion-content { transition: max-height 0.3s ease-out, padding 0.3s ease; max-height: 0; overflow: hidden; }
        .accordion-content.open { max-height: 4000px; }
        .accordion-icon { transition: transform 0.3s ease; }
        .accordion-btn[aria-expanded="true"] .accordion-icon { transform: rotate(180deg); }
        
        /* Tables */
        .spec-table tr:nth-child(even) { background-color: #F9FAFB; }
        .spec-table td, .spec-table th { padding: 1rem; text-align: center; border-bottom: 1px solid #E5E7EB; vertical-align: middle; }
        .spec-table td:first-child, .spec-table th:first-child { text-align: left; font-weight: 600; color: #374151; width: 35%; }
        .spec-table th { color: #111827; background-color: #F3F4F6; }
    </style>
@endsection

@section('content')

    {{-- 1. HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Animated Background Gradients --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[70%] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute top-[20%] -right-[10%] w-[40%] h-[60%] bg-purple-600/20 rounded-full blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[50%] bg-cyan-600/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-8 uppercase backdrop-blur-md shadow-lg shadow-blue-900/20">
                <i class="ri-rocket-2-line"></i> FutureCloud Shared Hosting
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
                Cepat, Aman & <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-200">Sangat Terjangkau.</span>
            </h1>
            
            <p class="mt-6 text-lg md:text-xl text-blue-100/80 max-w-2xl mx-auto leading-relaxed px-4 font-light">
                Solusi hosting terbaik untuk memulai website Anda dengan performa tinggi, keandalan server 99.9%, dan kemudahan cPanel.
            </p>
        </div>
    </section>

    {{-- 2. PRICING SECTION --}}
    <section class="w-full py-16 px-0 md:px-4 bg-gray-50 -mt-10 rounded-t-[3rem] relative z-20">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 px-4">
                <h2 class="text-3xl font-bold text-gray-900">Pilih Paket Hosting</h2>
                <p class="text-gray-500 mt-2">Buat website online dengan biaya lebih hemat.</p>
            </div>

            {{-- BILLING CYCLE SWITCHER --}}
            <div class="flex flex-wrap justify-center gap-2 mb-12 px-4">
                <button class="billing-btn active px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="monthly" onclick="updateHostingPricing('monthly')">Bulanan</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="annually" onclick="updateHostingPricing('annually')">1 Tahun</button>
                <button class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="biennially" onclick="updateHostingPricing('biennially')">2 Tahun</button>
            </div>

            <div class="max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 px-6 pt-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible items-start">
                
                @foreach ($hostings as $plan)
                    @php
                        // --- PRE-CALCULATE PHP (DEFAULT MONTHLY) ---
                        $cycleKey = 'monthly';
                        $config = $plan->discount_config[$cycleKey] ?? [];

                        // 1. Tentukan Harga Normal (Custom vs Auto)
                        $basePrice = $plan->price;
                        $normalPrice = $basePrice; 
                        
                        if (!empty($config['custom_price']) && is_numeric($config['custom_price']) && $config['custom_price'] > 0) {
                            $normalPrice = (float) $config['custom_price'];
                        }

                        // 2. Hitung Diskon
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

                    <div class="hosting-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 
                        {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($plan->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200') }}"
                        
                        data-base-price="{{ $plan->price }}" 
                        data-plan-name="{{ $plan->name }}"
                        data-tag="{{ $plan->tag ?? '' }}"
                        data-discount-config='{{ json_encode($plan->discount_config ?? []) }}'>

                        {{-- BADGE TENGAH --}}
                        <span class="card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
                             {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($plan->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                            {{ $isPromo ? 'PROMO' : ($plan->tag ?? '') }}
                        </span>

                        <div class="flex-1">
                            <div class="text-center pb-4 border-b border-gray-50 mb-4">
                                <h4 class="font-extrabold text-2xl text-gray-800">{{ $plan->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Shared Hosting</p>
                            </div>

                            {{-- AREA HARGA --}}
                            <div class="price-container flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                {{-- Label Acara --}}
                                <div class="promo-label-container {{ $isPromo && $promoLabel ? '' : 'hidden' }}">
                                    <span class="promo-label text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                </div>

                                {{-- Harga Coret --}}
                                <div class="strike-container flex items-center justify-center gap-2 text-xs {{ $isPromo ? '' : 'hidden' }}">
                                    <span class="strike-price text-gray-400 line-through decoration-red-300">
                                        Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-info text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                        {{ $promoInfo }}
                                    </span>
                                </div>

                                {{-- HARGA FINAL (HORIZONTAL) --}}
                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span class="text-4xl font-extrabold tracking-tight price-text leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-400 cycle-label">/bln</span>
                                </div>
                            </div>

                            <ul class="space-y-4 text-sm text-gray-600">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1 bg-green-100 rounded-full shrink-0">
                                            <i class="ri-check-line text-green-600 text-xs font-bold"></i>
                                        </div>
                                        <span class="font-medium">{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ route('order.config.cpanel', ['product_name' => $plan->name, 'price' => $finalPrice]) }}&cycle=monthly" 
                           class="order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold text-sm border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 
                           {{ $isPromo ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                            Mulai Sekarang
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. FEATURE HIGHLIGHTS --}}
    <section class="w-full py-16 px-4 bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Fitur Unggulan Shared Hosting</h2>
                <p class="mt-3 text-gray-600">Semua yang Anda butuhkan untuk mengelola website dengan mudah.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-y-8 gap-x-12">
                <div class="flex items-start gap-4">
                    <i class="ri-rocket-2-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Unmetered Bandwidth</h3>
                        <p class="text-gray-600 text-sm mt-1">Tidak ada batasan lalu lintas data. Website Anda dapat menangani pengunjung sebanyak mungkin tanpa khawatir kuota.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-shield-keyhole-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Free SSL Otomatis</h3>
                        <p class="text-gray-600 text-sm mt-1">Keamanan standar industri. Sertifikat SSL terpasang otomatis untuk melindungi data pengunjung.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-layout-2-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Website Builder Gratis</h3>
                        <p class="text-gray-600 text-sm mt-1">Buat website profesional dengan mudah tanpa koding menggunakan tool AI Website Builder kami.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-hard-drive-2-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Penyimpanan SSD Cepat</h3>
                        <p class="text-gray-600 text-sm mt-1">Menggunakan penyimpanan SSD modern untuk akses data super cepat dan performa maksimal.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-customer-service-2-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Support 24/7</h3>
                        <p class="text-gray-600 text-sm mt-1">Tim ahli kami siap membantu Anda kapan saja melalui Live Chat jika Anda mengalami kendala.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-mail-check-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Email Profesional</h3>
                        <p class="text-gray-600 text-sm mt-1">Buat alamat email bisnis dengan nama domain Anda sendiri untuk terlihat lebih profesional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. TECH SPECS ACCORDION --}}
    <section class="w-full py-16 px-4 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">Spesifikasi Teknis</h2>
            <p class="text-center text-gray-500 mb-10">Detail lengkap spesifikasi Shared Hosting FutureCloud.</p>
            
            <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden bg-white">
                
                {{-- A. PLAN FEATURES --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(1)" aria-expanded="true">
                        <span class="font-bold text-lg">Fitur Paket (Plan Features)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-1" class="accordion-content open">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Paket 1</th>
                                        <th>Paket 2</th>
                                        <th>Paket 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Disk Space</td><td>20 GB SSD</td><td>Unmetered SSD</td><td>50 GB SSD</td></tr>
                                    <tr><td>File (Inode) Limit</td><td>300.000</td><td>300.000</td><td>600.000</td></tr>
                                    <tr><td>Bandwidth</td><td>Unmetered</td><td>Unmetered</td><td>Unmetered</td></tr>
                                    <tr><td>Uptime</td><td>100%</td><td>100%</td><td>100%</td></tr>
                                    <tr><td>Hosted Domains</td><td>3</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>Parked Domains</td><td>Unlimited</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>Subdomains</td><td>30</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>Backups</td><td>Dua kali seminggu</td><td>Dua kali seminggu + AutoBackup</td><td>Dua kali seminggu + AutoBackup</td></tr>
                                    <tr><td>Cloud Storage</td><td>Included w/ EU & SG</td><td>Included w/ EU & SG</td><td>Included w/ EU, US, & SG</td></tr>
                                    <tr><td>cPanel (Control Panel)</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>AI for WordPress</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Imunify360 Security</td><td>&mdash;</td><td>&mdash;</td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Dedicated IP</td><td>Rp 70.500/bln</td><td>Rp 70.500/bln</td><td>Rp 70.500/bln</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- B. EMAIL FEATURES --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(2)" aria-expanded="false">
                        <span class="font-bold text-lg">Fitur Email</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-2" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <tbody>
                                    <tr><td>Email Accounts</td><td>30</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>Email Forwarders</td><td>Per mailbox: 20<br>Per domain: 200</td><td>Per mailbox: 20<br>Per domain: 200</td><td>Per mailbox: 20<br>Per domain: 200</td></tr>
                                    <tr><td>Email Autoresponders</td><td>Unlimited</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>Webmail</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>SMTP, POP3, IMAP</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>SpamAssassin</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Mailing Lists</td><td>10</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>BoxTrapper</td><td>&mdash;</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Jellyfish Spam Protection</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- C. DATABASES & SERVER --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(3)" aria-expanded="false">
                        <span class="font-bold text-lg">Database & Server</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-3" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <tbody>
                                    <tr><td>MySQL Databases</td><td>50</td><td>Unlimited</td><td>Unlimited</td></tr>
                                    <tr><td>phpMyAdmin</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Webserver</td><td>Apache/Litespeed</td><td>Apache/Litespeed</td><td>Apache/Litespeed</td></tr>
                                    <tr><td>PHP 5.X - 8.X</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Node.JS 6.X - 22.X</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Python 2.X - 3.X</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>SSH Access (Jailed)</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- D. CONTROL PANEL & STATS --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(4)" aria-expanded="false">
                        <span class="font-bold text-lg">Control Panel & Stats</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-4" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <tbody>
                                    <tr><td>Backup Manager</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Virus Scanner</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Hotlink Protection</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>AWStats</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Raw Logs</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Resource Usage</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- E. SCRIPTS & SUPPORT --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(5)" aria-expanded="false">
                        <span class="font-bold text-lg">Scripts & Support</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-5" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <tbody>
                                    <tr><td>Softaculous Installer</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>WordPress/Joomla/Drupal</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>24/7 Live Chat</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Instant Setup</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                    <tr><td>Transfer Assistance</td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td><td><i class="ri-check-line text-green-500 font-bold"></i></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- F. PRICING SUMMARY --}}
                <div class="border-b border-gray-200">
                    <button class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition" onclick="toggleAccordion(6)" aria-expanded="false">
                        <span class="font-bold text-lg">Harga (Pricing)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-6" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Paket 1</th>
                                        <th>Paket 2</th>
                                        <th>Paket 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1 Bulan</td><td>Rp 86.000</td><td>Rp 121.000</td><td>Rp 174.000</td></tr>
                                    <tr><td>1 Tahun</td><td>Rp 403.000</td><td>Rp 614.000</td><td>Rp 1.036.000</td></tr>
                                    <tr><td>2 Tahun</td><td>Rp 860.000</td><td>Rp 1.318.000</td><td>Rp 1.987.000</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA FOOTER (Style VPS) --}}
    <section class="w-full py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto bg-blue-600 rounded-3xl p-10 md:p-16 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Mulai Website Impian Anda Sekarang</h2>
                <p class="text-blue-100 mb-8 text-lg">Dapatkan performa hosting terbaik dengan dukungan teknis 24/7 dari FutureCloud.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="#" onclick="document.querySelector('.hosting-card').scrollIntoView({behavior: 'smooth'})"
                        class="px-8 py-3 bg-white text-blue-700 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">Lihat Paket</a>
                    <a href="https://wa.me/6281289537549?text=Halo%20Tim%20Sales%20FutureCloud%2C%20saya%20tertarik%20dengan%20layanan%20Anda%20dan%20ingin%20berkonsultasi.%20Terima%20kasih."
                        target="_blank"
                        class="px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white/10 transition">
                        <i class="ri-whatsapp-line text-lg"></i> Hubungi Sales
                    </a>
                </div>
            </div>
            {{-- Decoration --}}
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-500 rounded-full opacity-50 blur-3xl"></div>
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-cyan-500 rounded-full opacity-30 blur-3xl"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateHostingPricing('monthly');
        });

        function updateHostingPricing(cycle) {
            // 1. Update Tombol Active
            document.querySelectorAll('.billing-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                btn.classList.add('border-gray-300', 'text-gray-600');
                if(btn.getAttribute('data-cycle') === cycle) {
                    btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.remove('border-gray-300', 'text-gray-600', 'hover:bg-gray-100');
                }
            });

            // 2. Update Card
            const cards = document.querySelectorAll('.hosting-card');
            cards.forEach(card => {
                try {
                    const basePriceMonthly = parseFloat(card.getAttribute('data-base-price'));
                    const planName = card.getAttribute('data-plan-name');
                    const planTag = card.getAttribute('data-tag');
                    
                    let discountConfig = {};
                    try { discountConfig = JSON.parse(card.getAttribute('data-discount-config')); } catch(e) { discountConfig = {}; }
                    
                    // Elemen HTML
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
                    else if (cycle === 'biennially') { months = 24; cycleKey = 'biennially'; cycleText = '/2 thn'; }
                    else { months = 1; cycleKey = 'monthly'; cycleText = '/bln'; }

                    // --- 1. HARGA NORMAL (CUSTOM vs AUTO) ---
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
                    // Reset Class
                    card.className = "hosting-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1";

                    if(isPromo) {
                        // TEMA PROMO
                        card.classList.add('border-2', 'border-red-500', 'shadow-red-50');
                        
                        if(badgeEl) {
                            badgeEl.innerText = 'PROMO';
                            badgeEl.className = 'card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-red-600 to-red-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white';
                            badgeEl.classList.remove('hidden');
                        }

                        if(eventLabel && promoLabelEl) {
                            promoLabelEl.innerText = eventLabel;
                            promoLabelContainer.classList.remove('hidden');
                        } else {
                            promoLabelContainer.classList.add('hidden');
                        }

                        if(strikePriceEl && discountInfoEl) {
                            strikePriceEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalNormalPrice);
                            discountInfoEl.innerText = promoTypeInfo;
                            strikeContainer.classList.remove('hidden');
                        }

                        if(priceTextEl) {
                            priceTextEl.className = 'text-4xl font-extrabold tracking-tight price-text leading-none text-red-600';
                        }
                        if(btnEl) btnEl.className = 'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold text-sm border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-red-600 text-white hover:bg-red-700 shadow-red-200';

                    } else {
                        // TEMA NORMAL
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
                        
                        if(priceTextEl) {
                            priceTextEl.className = 'text-4xl font-extrabold tracking-tight price-text leading-none text-blue-600';
                        }
                        if(btnEl) btnEl.className = 'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold text-sm border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200';
                    }

                    // Update Text
                    if(priceTextEl) priceTextEl.innerText = new Intl.NumberFormat('id-ID').format(finalPrice);
                    if(cycleLabelEl) cycleLabelEl.innerText = cycleText;

                    // Update Link
                    if(btnEl) {
                        const baseUrl = "{{ url('/order/cpanel') }}";
                        btnEl.href = `${baseUrl}?product_name=${encodeURIComponent(planName)}&price=${finalPrice}&cycle=${cycle}`;
                    }
                
                } catch(error) {
                    console.error("Error updating hosting card", error);
                }
            });
        }

        // Accordion
        function toggleAccordion(id) {
            const content = document.getElementById('accordion-' + id);
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0px'; content.classList.remove('open');
            } else {
                content.style.maxHeight = '4000px'; content.classList.add('open');
            }
        }
    </script>
@endsection