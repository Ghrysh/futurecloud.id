@extends('layouts.landing')

@section('title', 'VPS Hosting - FutureCloud.id')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        i {
            display: inline-block !important;
            visibility: visible !important;
        }

        /* Toggle Switcher */
        .billing-btn {
            transition: all 0.3s ease;
        }

        .billing-btn.active {
            background-color: #2563EB;
            color: white;
            border-color: #2563EB;
        }

        /* Accordion */
        .accordion-content {
            transition: max-height 0.3s ease-out, padding 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }

        .accordion-content.open {
            max-height: 2000px;
        }

        .accordion-icon {
            transition: transform 0.3s ease;
        }

        .accordion-btn[aria-expanded="true"] .accordion-icon {
            transform: rotate(180deg);
        }

        /* Tables */
        .spec-table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .spec-table td,
        .spec-table th {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid #E5E7EB;
            vertical-align: middle;
        }

        .spec-table td:first-child,
        .spec-table th:first-child {
            text-align: left;
            font-weight: 600;
            color: #374151;
            width: 30%;
        }

        .spec-table th {
            color: #111827;
            background-color: #F3F4F6;
        }

        .mgmt-header th {
            background-color: white;
            border-bottom: 2px solid #E5E7EB;
            padding-bottom: 1.5rem;
        }

        .text-small-desc {
            font-size: 0.75rem;
            color: #6B7280;
            display: block;
            margin-top: 0.25rem;
            font-weight: normal;
        }
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
                <i class="ri-server-line"></i> FutureCloud Cloud VPS
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
                Performa Maksimal,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-200">Kendali Total di Tangan Anda.</span>
            </h1>
            
            <p class="mt-6 text-lg md:text-xl text-blue-100/80 max-w-2xl mx-auto leading-relaxed px-4 font-light">
                Infrastruktur NVMe SSD berkecepatan tinggi dengan akses root penuh. Dirancang untuk skalabilitas aplikasi dan bisnis masa depan.
            </p>
        </div>
    </section>

    {{-- 2. PRICING SECTION --}}
    <section class="w-full py-16 px-0 md:px-4 bg-gray-50 -mt-10 rounded-t-[3rem] relative z-20">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 px-4">
                <h2 class="text-3xl font-bold text-gray-900">Pilih Paket VPS Anda</h2>
                <p class="text-gray-500 mt-2">Buat lebih banyak online dengan biaya lebih hemat.</p>
            </div>

            {{-- BILLING CYCLE SWITCHER --}}
            <div class="flex flex-wrap justify-center gap-2 mb-12 px-4">
                <button
                    class="billing-btn active px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="monthly" onclick="updatePricing('monthly')">Bulanan</button>
                <button
                    class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="quarterly" onclick="updatePricing('quarterly')">3 Bulan</button>
                <button
                    class="billing-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-semibold text-sm md:text-base hover:bg-gray-100"
                    data-cycle="annually" onclick="updatePricing('annually')">1 Tahun</button>
            </div>

            <div
                class="max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 px-6 pt-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible items-start">
                @foreach ($vps as $plan)
                    @php
                        // --- LOGIC PHP ---
                        $cycleKey = 'monthly';
                        $config = $plan->discount_config[$cycleKey] ?? [];
                        $normalPrice = $plan->price;
                        if (!empty($config['custom_price']) && $config['custom_price'] > 0) {
                            $normalPrice = (float) $config['custom_price'];
                        }
                        $finalPrice = $normalPrice;
                        $promoLabel = $config['label'] ?? '';
                        $promoInfo = '';
                        $isPromo = false;
                        $type = $config['type'] ?? 'none';
                        $val = $config['value'] ?? 0;

                        if ($type == 'percent' && $val > 0) {
                            $discountAmount = $normalPrice * ($val / 100);
                            $finalPrice = $normalPrice - $discountAmount;
                            $promoInfo = "Diskon $val%";
                        } elseif ($type == 'fixed' && $val > 0) {
                            $finalPrice = (float) $val;
                            $promoInfo = 'Harga Spesial';
                        }
                        if ($finalPrice < $normalPrice) {
                            $isPromo = true;
                        }
                    @endphp

                    <div class="pricing-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 
        {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($plan->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200') }}"
                        data-base-price="{{ $plan->price }}"
                        data-discount-config='{{ json_encode($plan->discount_config ?? []) }}'
                        data-plan-name="{{ $plan->name }}" data-tag="{{ $plan->tag ?? '' }}">

                        {{-- BADGE --}}
                        <span
                            class="card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
             {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($plan->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                            {{ $isPromo ? 'PROMO' : $plan->tag ?? '' }}
                        </span>

                        <div class="flex-1">
                            <div class="text-center pb-4 border-b border-gray-50 mb-4">
                                <h4 class="font-extrabold text-2xl text-gray-800">{{ $plan->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">VPS Hosting</p>
                            </div>

                            {{-- AREA HARGA (UPDATED LAYOUT) --}}
                            <div
                                class="price-container flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                {{-- Label Acara --}}
                                <div class="promo-label-container {{ $isPromo && $promoLabel ? '' : 'hidden' }}">
                                    <span
                                        class="promo-label text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                </div>

                                {{-- Harga Coret --}}
                                <div
                                    class="strike-container flex items-center justify-center gap-2 text-xs {{ $isPromo ? '' : 'hidden' }}">
                                    <span class="strike-price text-gray-400 line-through decoration-red-300">
                                        Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                    </span>
                                    <span
                                        class="discount-info text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                        {{ $promoInfo }}
                                    </span>
                                </div>

                                {{-- HARGA FINAL (HORIZONTAL LAYOUT) --}}
                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span
                                        class="text-4xl font-extrabold tracking-tight price-text leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
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

                        <a href="{{ route('order.config.vps', ['product_name' => $plan->name, 'price' => $finalPrice]) }}&cycle=monthly"
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
                <h2 class="text-3xl font-extrabold text-gray-900">Hemat Biaya Hosting, Dapatkan Fitur Maksimal</h2>
                <p class="mt-3 text-gray-600">Dapatkan keamanan lebih dan kendali penuh dengan harga yang masuk akal.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-y-8 gap-x-12">
                <div class="flex items-start gap-4">
                    <i class="ri-terminal-window-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Akses Root Penuh & Pilihan OS</h3>
                        <p class="text-gray-600 text-sm mt-1">Anda memegang kendali. Instal software apa saja, atur
                            konfigurasi server sesuai kebutuhan spesifik FutureCloud Anda.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-shield-check-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Standar Keamanan Tertinggi</h3>
                        <p class="text-gray-600 text-sm mt-1">Dilengkapi firewall perangkat lunak dan paket keamanan
                            internal untuk menjaga lingkungan hosting virtual Anda tetap aman.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-exchange-box-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Gratis Transfer Website</h3>
                        <p class="text-gray-600 text-sm mt-1">Pindah ke FutureCloud.id? Tim teknis kami akan membantu
                            memindahkan website dan VPS lama Anda secara gratis.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-refund-2-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Jaminan Uang Kembali 30 Hari</h3>
                        <p class="text-gray-600 text-sm mt-1">Kami yakin dengan kualitas kami. Jika tidak puas dalam 30 hari
                            pertama, uang Anda kembali.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-settings-4-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Fleksibilitas Total</h3>
                        <p class="text-gray-600 text-sm mt-1">Upgrade resource kapan saja saat bisnis Anda berkembang tanpa
                            downtime yang berarti.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="ri-server-line text-3xl text-blue-500"></i>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Pilihan Manajemen Server</h3>
                        <p class="text-gray-600 text-sm mt-1">Pilih antara User-Responsible (Mandiri), Basic, atau Complete
                            Management sesuai keahlian teknis Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. CONTROL PANELS SECTION --}}
    <section class="w-full py-16 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-center text-3xl font-bold text-gray-900 mb-10">Web Panel yang Tersedia</h2>

            <div class="grid md:grid-cols-2 gap-8">
                <div
                    class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-full md:w-1/3 flex justify-center">
                        <div class="text-2xl font-bold text-blue-900 tracking-tighter">webuzo</div>
                    </div>
                    <div class="w-full md:w-2/3">
                        <p class="text-gray-600 text-sm mb-4">Menyederhanakan manajemen server untuk kebutuhan dasar hingga
                            lanjutan. Kelola file, email, dan DNS dengan mudah.</p>
                        <ul class="text-sm space-y-2 text-gray-700">
                            <li class="flex items-center gap-2"><i class="ri-check-line text-green-500"></i> Supports
                                AlmaLinux & Ubuntu</li>
                            <li class="flex items-center gap-2"><i class="ri-check-line text-green-500"></i> Multi-level
                                access</li>
                        </ul>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-full md:w-1/3 flex justify-center">
                        <div class="text-2xl font-bold text-orange-600 tracking-tighter">cPanel</div>
                    </div>
                    <div class="w-full md:w-2/3">
                        <p class="text-gray-600 text-sm mb-4">Standar industri hosting. Mencakup semua yang Anda butuhkan
                            untuk menjalankan akun hosting di satu tempat (WHM & cPanel).</p>
                        <ul class="text-sm space-y-2 text-gray-700">
                            <li class="flex items-center gap-2"><i class="ri-check-line text-green-500"></i> Supports
                                AlmaLinux</li>
                            <li class="flex items-center gap-2"><i class="ri-check-line text-green-500"></i> Admin & User
                                level access</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. TECH SPECS ACCORDION --}}
    <section class="w-full py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">Spesifikasi Teknis</h2>
            <p class="text-center text-gray-500 mb-10">Detail lengkap spesifikasi server VPS FutureCloud.</p>

            <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden bg-white">

                {{-- A. PLAN FEATURES --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(1)" aria-expanded="true">
                        <span class="font-bold text-lg">Fitur Paket (Plan Features)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-1" class="accordion-content open">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CPU</td>
                                        <td>2</td>
                                        <td>4</td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td>RAM</td>
                                        <td>2048 MB</td>
                                        <td>6144 MB</td>
                                        <td>12288 MB</td>
                                    </tr>
                                    <tr>
                                        <td>Disk Space</td>
                                        <td>40 GB SSD Raid 10</td>
                                        <td>120 GB SSD Raid 10</td>
                                        <td>240 GB SSD Raid 10</td>
                                    </tr>
                                    <tr>
                                        <td>Bandwidth</td>
                                        <td>1000 GB/bln</td>
                                        <td>3000 GB/bln</td>
                                        <td>6000 GB/bln</td>
                                    </tr>
                                    <tr>
                                        <td>Uptime</td>
                                        <td>99.9%</td>
                                        <td>99.9%</td>
                                        <td>99.9%</td>
                                    </tr>
                                    <tr>
                                        <td>Backups</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Offsite Backup Storage</td>
                                        <td>&mdash;</td>
                                        <td>100 GB Included with Complete management</td>
                                        <td>200 GB Included with Complete management</td>
                                    </tr>
                                    <tr>
                                        <td>Dedicated IP</td>
                                        <td>1 IPv4</td>
                                        <td>Up to 2 IPv4</td>
                                        <td>Up to 2 IPv4</td>
                                    </tr>
                                    <tr>
                                        <td>Access Level</td>
                                        <td>Root</td>
                                        <td>Root / reseller depending on server management type</td>
                                        <td>Root / reseller depending on server management type</td>
                                    </tr>
                                    <tr>
                                        <td>Customized Configuration</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Streaming Audio/Video</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Money-back Guarantee</td>
                                        <td>30 hari</td>
                                        <td>30 hari</td>
                                        <td>30 hari</td>
                                    </tr>
                                    <tr>
                                        <td>No Contract Required</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- B. OPERATING SYSTEM --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(2)" aria-expanded="false">
                        <span class="font-bold text-lg">Sistem Operasi (Operating System)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-2" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>AlmaLinux 9 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Ubuntu 20.04 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Ubuntu 22.04 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Ubuntu 24.04 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Debian 11 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Debian 12 (64 Bit)</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- C. SOFTWARE --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(3)" aria-expanded="false">
                        <span class="font-bold text-lg">Perangkat Lunak (Software)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-3" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Webuzo</td>
                                        <td>Rp 51.000/bln *</td>
                                        <td>Rp 51.000/bln *</td>
                                        <td>Rp 51.000/bln *</td>
                                    </tr>
                                    <tr>
                                        <td>cPanel</td>
                                        <td>Rp 297.000/bln *</td>
                                        <td>Rp 297.000/bln *</td>
                                        <td>Rp 297.000/bln *</td>
                                    </tr>
                                    <tr>
                                        <td>Softaculous script installer</td>
                                        <td>Rp 26.500/bln</td>
                                        <td>Rp 26.500/bln</td>
                                        <td>Rp 26.500/bln</td>
                                    </tr>
                                    <tr>
                                        <td>WHMCS Starter license</td>
                                        <td>Rp 141.000/bln</td>
                                        <td>Rp 141.000/bln</td>
                                        <td>Rp 141.000/bln</td>
                                    </tr>
                                    <tr>
                                        <td>WHMCS Plus license</td>
                                        <td>Rp 352.000/bln</td>
                                        <td>Rp 352.000/bln</td>
                                        <td>Rp 352.000/bln</td>
                                    </tr>
                                    <tr>
                                        <td>WHMCS Professional license</td>
                                        <td>Rp 599.000/bln</td>
                                        <td>Rp 599.000/bln</td>
                                        <td>Rp 599.000/bln</td>
                                    </tr>
                                    <tr>
                                        <td>WHMCS Business license</td>
                                        <td>Rp 1.021.000/bln</td>
                                        <td>Rp 1.021.000/bln</td>
                                        <td>Rp 1.021.000/bln</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- D. ADD-ONS --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(4)" aria-expanded="false">
                        <span class="font-bold text-lg">Layanan Tambahan (Add-Ons)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-4" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Extra 1024 MB RAM</td>
                                        <td>Rp 123.500/bln</td>
                                        <td>Rp 123.500/bln</td>
                                        <td>Rp 123.500/bln</td>
                                    </tr>
                                    <tr>
                                        <td>Extra disk space</td>
                                        <td>Rp 53.000/bln per 10GB</td>
                                        <td>Rp 53.000/bln per 10GB</td>
                                        <td>Rp 53.000/bln per 10GB</td>
                                    </tr>
                                    <tr>
                                        <td>Extra backup storage (Complete managed VPS)</td>
                                        <td>Rp 176.000/bln per 10GB</td>
                                        <td>Rp 176.000/bln per 10GB</td>
                                        <td>Rp 176.000/bln per 10GB</td>
                                    </tr>
                                    <tr>
                                        <td>Extra bandwidth</td>
                                        <td>Rp 176.000/bln per 100GB</td>
                                        <td>Rp 176.000/bln per 100GB</td>
                                        <td>Rp 176.000/bln per 100GB</td>
                                    </tr>
                                    <tr>
                                        <td>Extra dedicated IP</td>
                                        <td>Rp 70.500/bln per IP</td>
                                        <td>Rp 70.500/bln per IP</td>
                                        <td>Rp 70.500/bln per IP</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- E. SUPPORT FEATURES --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(5)" aria-expanded="false">
                        <span class="font-bold text-lg">Fitur Dukungan (Support Features)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-5" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>24/7 Live Chat</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>24/7 Help Center</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Setup</td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                        <td><i class="ri-check-line text-green-500 font-bold"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- F. PRICING SUMMARY --}}
                <div class="border-b border-gray-200">
                    <button
                        class="accordion-btn w-full px-6 py-4 flex justify-between items-center bg-gray-600 text-white hover:bg-gray-700 transition"
                        onclick="toggleAccordion(6)" aria-expanded="false">
                        <span class="font-bold text-lg">Harga (Pricing)</span>
                        <i class="ri-arrow-down-s-line accordion-icon text-xl"></i>
                    </button>
                    <div id="accordion-6" class="accordion-content">
                        <div class="overflow-x-auto">
                            <table class="w-full spec-table text-sm text-gray-700">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Entry Level</th>
                                        <th>Popular</th>
                                        <th>High Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 Bulan</td>
                                        <td>Rp 174.000</td>
                                        <td>Rp 279.500</td>
                                        <td>Rp 508.500</td>
                                    </tr>
                                    <tr>
                                        <td>3 Bulan</td>
                                        <td>Rp 469.000</td>
                                        <td>Rp 786.000</td>
                                        <td>Rp 1.420.000</td>
                                    </tr>
                                    <tr>
                                        <td>1 Tahun</td>
                                        <td>Rp 1.453.000</td>
                                        <td>Rp 2.720.000</td>
                                        <td>Rp 5.255.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 6. SERVER MANAGEMENT COMPARISON TABLE (UPDATED) --}}
    <section class="w-full py-20 px-4 bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Manajemen Server VPS</h2>
            <p class="text-center text-gray-600 max-w-3xl mx-auto mb-12">Pilih tipe manajemen yang Anda inginkan saat
                pembelian. Waktu provisioning bervariasi tergantung tipe manajemen. Complete Management membutuhkan waktu
                hingga 24 jam.</p>

            <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
                <table class="w-full spec-table text-sm text-gray-700">
                    <thead class="mgmt-header">
                        <tr>
                            <th class="text-left align-bottom text-lg p-6">Fitur</th>
                            <th class="align-bottom p-6 w-1/4">
                                <span class="block text-gray-900 font-bold text-xl mb-1">User-Responsible</span>
                                <span class="block text-gray-500 font-semibold">GRATIS (default)</span>
                            </th>
                            <th class="align-bottom p-6 w-1/4">
                                <span class="block text-gray-900 font-bold text-xl mb-1">Basic</span>
                                <span class="block text-blue-600 font-bold text-lg">Rp 176.000 /bln</span>
                            </th>
                            <th class="align-bottom p-6 w-1/4 relative bg-gray-50">
                                <span
                                    class="absolute top-0 right-0 bg-yellow-400 text-white text-[10px] font-bold px-2 py-1 rounded-bl">UPDATED</span>
                                <span class="block text-gray-900 font-bold text-xl mb-1">Complete</span>
                                <span class="block text-blue-600 font-bold text-lg">Rp 440.000 /bln</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Peningkatan Keamanan (Security enhancements)</td>
                            <td>&mdash;</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Pemulihan Kegagalan Server (Restore server failure)</td>
                            <td>
                                <span class="font-bold text-gray-900">Rp 176.000</span>
                                <span class="text-small-desc">flat rate per restore</span>
                            </td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Perubahan Software Inti (Core software changes)</td>
                            <td>
                                <span class="font-bold text-gray-900">1 jam - Rp 264.000</span>
                                <span class="text-small-desc">flat rate</span>
                            </td>
                            <td>
                                <span class="font-bold text-gray-900">1 jam - Rp 176.000</span>
                                <span class="text-small-desc">flat rate</span>
                            </td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Perbaikan Penyebab Kegagalan (Fix server failure cause)</td>
                            <td>
                                <span class="font-bold text-gray-900">1 jam - Rp 264.000</span>
                                <span class="text-small-desc">flat rate</span>
                            </td>
                            <td>
                                <span class="font-bold text-gray-900">1 jam - Rp 176.000</span>
                                <span class="text-small-desc">flat rate</span>
                            </td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Saran Customer Support</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Setup VPS Awal</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Sistem Operasi</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td>
                                <i class="ri-check-line text-green-500 font-bold text-xl"></i>
                                <span class="text-small-desc">AlmaLinux</span>
                            </td>
                            <td class="bg-gray-50">
                                <i class="ri-check-line text-green-500 font-bold text-xl"></i>
                                <span class="text-small-desc">AlmaLinux</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Akses Root</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50">
                                &mdash;
                                <span class="text-small-desc">Demi keamanan</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Akses Reboot</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50">
                                &mdash;
                                <span class="text-small-desc">Demi keamanan</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Akses SolusVM</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50">
                                &mdash;
                                <span class="text-small-desc">Demi keamanan</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Masalah Hardware (Any hardware issues)</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Monitoring</td>
                            <td>&mdash;</td>
                            <td>
                                <i class="ri-check-line text-green-500 font-bold text-xl"></i>
                                <span class="text-small-desc">Respons proaktif saat isu terdeteksi</span>
                            </td>
                            <td class="bg-gray-50">
                                <i class="ri-check-line text-green-500 font-bold text-xl"></i>
                                <span class="text-small-desc">Respons proaktif saat isu terdeteksi</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Update Vendor</td>
                            <td>&mdash;</td>
                            <td><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                            <td class="bg-gray-50"><i class="ri-check-line text-green-500 font-bold text-xl"></i></td>
                        </tr>
                        <tr>
                            <td>Backup Offsite</td>
                            <td>&mdash;</td>
                            <td>&mdash;</td>
                            <td class="bg-gray-50">
                                <i class="ri-check-line text-green-500 font-bold text-xl"></i>
                                <span class="text-small-desc">Hingga 200 GB backup mingguan</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="mt-8 text-sm text-gray-500 text-center">
                Saat ini, add-on manajemen server Basic dan Complete hanya tersedia untuk paket VPS Quasar dan Magnetar.<br>
                Penyimpanan backup offsite dengan manajemen server Complete bergantung pada paket VPS dan mencakup 100 GB
                untuk Quasar serta 200 GB untuk paket Magnetar.
            </p>
        </div>
    </section>

    {{-- CTA FOOTER --}}
    <section class="w-full py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto bg-blue-600 rounded-3xl p-10 md:p-16 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap untuk Performa Lebih Cepat?</h2>
                <p class="text-blue-100 mb-8 text-lg">Bergabunglah dengan FutureCloud.id dan rasakan pengalaman VPS hosting
                    yang stabil dan aman.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="#"
                        onclick="document.querySelector('.pricing-card').scrollIntoView({behavior: 'smooth'})"
                        class="px-8 py-3 bg-white text-blue-700 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">Lihat
                        Paket</a>
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
            updatePricing('monthly');
        });

        function updatePricing(cycle) {
            // 1. Update Tombol Active
            document.querySelectorAll('.billing-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                btn.classList.add('border-gray-300', 'text-gray-600');
                if (btn.getAttribute('data-cycle') === cycle) {
                    btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.remove('border-gray-300', 'text-gray-600', 'hover:bg-gray-100');
                }
            });

            // 2. Loop Semua Kartu
            const cards = document.querySelectorAll('.pricing-card');
            cards.forEach(card => {
                try {
                    // Ambil Data
                    const basePriceMonthly = parseFloat(card.getAttribute('data-base-price'));
                    const planName = card.getAttribute('data-plan-name');
                    const planTag = card.getAttribute('data-tag'); // String kosong jika null

                    let discountConfig = {};
                    try {
                        discountConfig = JSON.parse(card.getAttribute('data-discount-config'));
                    } catch (e) {}

                    // Select Elements (Dengan Safety)
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

                    if (cycle === 'annually') {
                        months = 12;
                        cycleKey = 'annually';
                        cycleText = '/thn';
                    } else if (cycle === 'quarterly') {
                        months = 3;
                        cycleKey = 'quarterly';
                        cycleText = '/3 bln';
                    } else {
                        months = 1;
                        cycleKey = 'monthly';
                        cycleText = '/bln';
                    }

                    // --- HITUNG HARGA ---
                    let config = discountConfig[cycleKey] || {};
                    let totalNormalPrice = 0;

                    // Cek Custom Price
                    if (config.custom_price && parseFloat(config.custom_price) > 0) {
                        totalNormalPrice = parseFloat(config.custom_price);
                    } else {
                        totalNormalPrice = basePriceMonthly * months;
                    }

                    let finalPrice = totalNormalPrice;
                    let isPromo = false;
                    let eventLabel = '';
                    let promoTypeInfo = '';

                    // Cek Diskon
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
                        if (finalPrice < totalNormalPrice) isPromo = true;
                    }

                    // --- UPDATE TAMPILAN ---
                    // Reset Style
                    card.className =
                        "pricing-card flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1";

                    if (isPromo) {
                        card.classList.add('border-2', 'border-red-500', 'shadow-red-50');

                        // Update Badge
                        if (badgeEl) {
                            badgeEl.innerText = 'PROMO';
                            badgeEl.className =
                                'card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-red-600 to-red-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white';
                            badgeEl.classList.remove('hidden');
                        }

                        // Update Label Acara
                        if (promoLabelContainer && promoLabelEl) {
                            if (eventLabel) {
                                promoLabelEl.innerText = eventLabel;
                                promoLabelContainer.classList.remove('hidden');
                            } else {
                                promoLabelContainer.classList.add('hidden');
                            }
                        }

                        // Update Harga Coret
                        if (strikeContainer && strikePriceEl && discountInfoEl) {
                            strikePriceEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(
                                totalNormalPrice);
                            discountInfoEl.innerText = promoTypeInfo;
                            strikeContainer.classList.remove('hidden');
                        }

                        // Update Harga & Tombol Merah
                        if (priceTextEl) {
                            priceTextEl.classList.remove('text-blue-600');
                            priceTextEl.classList.add('text-red-600');
                        }
                        if (btnEl) btnEl.className =
                            'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold text-sm border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-red-600 text-white hover:bg-red-700 shadow-red-200';

                    } else {
                        // Tampilan Normal
                        if (planTag) {
                            card.classList.add('border-2', 'border-blue-500', 'shadow-blue-50');
                            if (badgeEl) {
                                badgeEl.innerText = planTag;
                                badgeEl.className =
                                    'card-badge absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white';
                                badgeEl.classList.remove('hidden');
                            }
                        } else {
                            card.classList.add('border-2', 'border-gray-200');
                            if (badgeEl) badgeEl.classList.add('hidden');
                        }

                        if (promoLabelContainer) promoLabelContainer.classList.add('hidden');
                        if (strikeContainer) strikeContainer.classList.add('hidden');

                        if (priceTextEl) {
                            priceTextEl.classList.remove('text-red-600');
                            priceTextEl.classList.add('text-blue-600');
                        }
                        if (btnEl) btnEl.className =
                            'order-btn block w-full mt-8 py-3.5 text-center rounded-xl font-bold text-sm border transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200';
                    }

                    // Update Text Nilai
                    if (priceTextEl) priceTextEl.innerText = new Intl.NumberFormat('id-ID').format(finalPrice);
                    if (cycleLabelEl) cycleLabelEl.innerText = cycleText;

                    // Update Link
                    if (btnEl) {
                        const baseUrl = "{{ url('/order/vps') }}";
                        btnEl.href =
                            `${baseUrl}?product_name=${encodeURIComponent(planName)}&price=${finalPrice}&cycle=${cycle}`;
                    }

                } catch (error) {
                    console.error("Error processing card:", error);
                }
            });
        }

        // Accordion Logic
        function toggleAccordion(id) {
            const content = document.getElementById('accordion-' + id);
            const btn = document.querySelector(`button[onclick="toggleAccordion(${id})"]`);

            // Toggle current
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0px';
                content.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                content.style.maxHeight = '2000px'; // Set enough height
                content.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        }
    </script>
@endsection
