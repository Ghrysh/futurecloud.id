@extends('layouts.landing')

@section('title', $hero->title ?? 'Technology That Creates Value')

@section('styles')
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .fade-enter-active,
        .fade-leave-active {
            transition: opacity 1s ease-in-out;
        }

        .fade-enter-from,
        .fade-leave-to {
            opacity: 0;
        }

        /* Animasi loading */
        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')

    {{-- HERO SLIDER LOGIC --}}
    @php
        $bgImages = $hero && $hero->background_images ? $hero->background_images : ['assets/bg.webp'];
        $slides = array_map(function ($path) {
            return str_starts_with($path, 'assets/') ? asset($path) : asset('storage/' . $path);
        }, $bgImages);
        $slideCount = count($slides);
    @endphp

    <section x-data="{
        activeSlide: 0,
        totalSlides: {{ $slideCount }},
        timer: null,
        startTimer() {
            if (this.totalSlides > 1) {
                this.timer = setInterval(() => { this.nextSlide(); }, 5000);
            }
        },
        stopTimer() { clearInterval(this.timer); },
        nextSlide() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; }
    }" x-init="startTimer()"
        class="w-full min-h-screen flex flex-col justify-center items-center text-center px-4 pt-24 pb-12 md:py-24 relative overflow-hidden bg-gray-900">

        @foreach ($slides as $index => $slide)
            <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-in-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in-out duration-1000" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-100" class="absolute inset-0 w-full h-full bg-cover bg-center"
                style="background-image: url('{{ $slide }}'); z-index: 0;">
            </div>
        @endforeach

        <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-[1]"></div>
        <div class="absolute bottom-0 left-0 w-full h-48 bg-gradient-to-t from-gray-50 to-transparent z-[2]"></div>

        <div class="relative z-10 max-w-6xl mx-auto w-full">
            <span
                class="inline-flex items-center gap-2 bg-white/80 backdrop-blur px-5 py-2 rounded-full shadow-lg text-sm md:text-base font-semibold text-gray-800 animate-fade-in-up">
                <i class="ri-sparkling-line text-blue-600 text-lg"></i>
                {{ $hero->tagline ?? 'Digital Partner for a Better Future' }}
            </span>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mt-8 text-gray-900 leading-tight">
                {!! $hero->title ?? 'Infrastruktur & Solusi Cloud<br /><span class="text-blue-600">Masa Depan</span>' !!}
            </h1>

            <p class="mt-6 text-base md:text-lg text-gray-700 max-w-2xl mx-auto px-2 font-medium">
                {{ $hero->subtitle ?? 'Mewujudkan masyarakat yang lebih berbudi luhur, inovatif dan sejahtera melalui solusi teknologi digital yang terintegrasi.' }}
            </p>

            {{-- SEARCH DOMAIN --}}
            <div class="mt-10 w-full px-0 md:px-4 relative z-20">
                <div
                    class="flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-xl shadow-2xl w-full max-w-xl lg:max-w-2xl mx-auto relative z-20">
                    <div class="flex items-center w-full sm:w-auto sm:flex-1 border-b sm:border-b-0 pb-2 sm:pb-0">
                        <div class="flex items-center pr-3">
                            <i class="ri-search-2-line text-2xl text-gray-500"></i>
                        </div>
                        <input id="domain-search-input" type="text" placeholder="Cari ketersediaan identitas digital Anda..."
                            class="flex-1 outline-none py-2 text-sm w-full placeholder:text-gray-500 text-gray-800 font-medium" />
                    </div>
                    <button id="check-domain-button"
                        class="px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold text-base hover:bg-blue-700 transition w-full sm:w-auto disabled:opacity-50">
                        Cek Ketersediaan
                    </button>
                </div>

                {{-- RESULT CONTAINER --}}
                <div id="availability-result"
                    class="mt-4 max-w-xl lg:max-w-2xl mx-auto hidden relative z-20 text-left bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
                    <div id="main-result-container"></div>
                    <div id="alternatives-wrapper" class="hidden border-t border-gray-100">
                        <div
                            class="bg-gray-50 px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wide border-b border-gray-100">
                            Pilihan Lainnya
                        </div>
                        <div id="alternatives-list-container"></div>
                    </div>
                </div>
            </div>

            {{-- DOMAIN TAGS --}}
            <div
                class="flex flex-wrap gap-2 md:gap-3 justify-center mt-6 text-gray-600 text-sm md:text-base px-2 relative z-10">
                <span class="px-3 py-1 w-full text-center sm:w-auto font-semibold text-gray-800">Ekstensi populer:</span>
                <span data-extension=".com"
                    class="domain-extension-tag px-3 py-1 md:px-4 bg-white/80 hover:bg-white rounded-full shadow-md text-center cursor-pointer transition font-bold text-blue-600">.com</span>
                <span data-extension=".id"
                    class="domain-extension-tag px-3 py-1 md:px-4 bg-white/80 hover:bg-white rounded-full shadow-md text-center cursor-pointer transition font-bold text-red-600">.id</span>
                <span data-extension=".net"
                    class="domain-extension-tag px-3 py-1 md:px-4 bg-white/80 hover:bg-white rounded-full shadow-md text-center cursor-pointer transition font-bold text-orange-600">.net</span>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10 px-4 w-full sm:w-auto relative z-10">
                <a href="{{ url('/services') }}"
                    class="w-full sm:w-auto px-8 py-3 bg-white/90 backdrop-blur shadow-lg rounded-xl border outline outline-2 outline-blue-600 text-blue-600 font-semibold hover:bg-white transition text-base text-center">
                    Jelajahi Solusi Kami
                </a>
            </div>
        </div>

        @if ($slideCount > 1)
            <div class="absolute bottom-8 left-0 right-0 z-20 flex justify-center gap-2">
                @foreach ($slides as $index => $slide)
                    <button @click="stopTimer(); activeSlide = {{ $index }}; startTimer()"
                        :class="activeSlide === {{ $index }} ? 'bg-blue-600 w-8' : 'bg-white/50 w-2 hover:bg-white'"
                        class="h-2 rounded-full transition-all duration-300 shadow-sm">
                    </button>
                @endforeach
            </div>
        @endif
    </section>

    <!-- TENTANG FUTURECLOUD -->
    <section class="scroll-reveal w-full py-16 md:py-24 bg-white px-4">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-bold mb-4">
                    <i class="ri-rocket-line"></i> PT Berkah Teknologi Terdepan
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Solusi <span class="text-blue-600">Teknologi Terintegrasi</span> dari Ide Hingga Dampak
                </h2>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Kami adalah perusahaan teknologi yang berbasis di Jakarta, berfokus pada pengembangan solusi digital, konsultasi teknologi, SaaS, enterprise system (ERP), serta transformasi proses bisnis. Kami percaya teknologi mampu menciptakan value, membuka peluang baru, dan meningkatkan produktivitas untuk masa depan yang lebih baik.
                </p>
                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <span class="text-3xl font-extrabold text-gray-900">4 Pilar</span>
                        <span class="text-sm text-gray-500 font-medium mt-1">Kapabilitas Ekosistem Digital</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-extrabold text-gray-900">{{ number_format($clientCount) }}</span>
                        <span class="text-sm text-gray-500 font-medium mt-1">Klien & Partner Terpercaya</span>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 relative">
                <!-- Ilustrasi Dekoratif -->
                <div class="absolute inset-0 bg-blue-100 rounded-3xl transform rotate-3 scale-105 z-0"></div>
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop" alt="Tim Support FutureCloud" class="relative z-10 w-full h-auto rounded-3xl shadow-xl object-cover">
            </div>
        </div>
    </section>

    <section class="scroll-reveal w-full py-12 md:py-20 bg-gray-50 px-0 md:px-4">
        <h2 class="text-center text-3xl md:text-4xl font-bold text-gray-900 px-4">Layanan & <span
                class="text-blue-600">Ekosistem Kami</span></h2>
        <p class="text-center text-gray-600 mt-3 max-w-2xl mx-auto px-4">
            Pilih dari berbagai kapabilitas teknologi terintegrasi kami
        </p>

        <div class="flex justify-center mt-6 md:mt-10">
            <div id="serviceTabs"
                class="grid grid-cols-4 w-full md:w-auto bg-gray-100 p-1 md:p-2 rounded-xl gap-1 md:gap-1 shadow-inner">
                <div data-tab="domain"
                    class="tab-item flex flex-col md:flex-row items-center justify-center gap-1 md:gap-2 px-1 py-2 md:px-5 md:py-3 rounded-lg md:rounded-xl cursor-pointer transition text-gray-900 font-semibold bg-white shadow-md text-center">
                    <i class="ri-globe-line text-sm md:text-lg"></i>
                    <span class="text-[10px] md:text-base font-medium leading-none">Identitas Digital</span>
                </div>
                <div data-tab="vps"
                    class="tab-item flex flex-col md:flex-row items-center justify-center gap-1 md:gap-2 px-1 py-2 md:px-5 md:py-3 rounded-lg md:rounded-xl cursor-pointer transition text-gray-500 hover:text-gray-900 font-medium text-center">
                    <i class="ri-server-line text-sm md:text-lg"></i>
                    <span class="text-[10px] md:text-base font-medium leading-none">Cloud & VPS</span>
                </div>
                <div data-tab="cpanel"
                    class="tab-item flex flex-col md:flex-row items-center justify-center gap-1 md:gap-2 px-1 py-2 md:px-5 md:py-3 rounded-lg md:rounded-xl cursor-pointer transition text-gray-500 hover:text-gray-900 font-medium text-center">
                    <i class="ri-settings-4-line text-sm md:text-lg"></i>
                    <span class="text-[10px] md:text-base font-medium leading-none">Infrastruktur</span>
                </div>
                <div data-tab="saas"
                    class="tab-item flex flex-col md:flex-row items-center justify-center gap-1 md:gap-2 px-1 py-2 md:px-5 md:py-3 rounded-lg md:rounded-xl cursor-pointer transition text-gray-500 hover:text-gray-900 font-medium text-center">
                    <i class="ri-briefcase-line text-sm md:text-lg"></i>
                    <span class="text-[10px] md:text-base font-medium leading-none">SaaS & Bisnis</span>
                </div>
            </div>
        </div>

        <div class="mt-6" id="tabContent">
            {{-- DOMAIN CONTENT --}}
            <div data-content="domain">
                <div class="text-center mt-8 md:mt-12 px-4">
                    <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl">
                        <i class="ri-global-line text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mt-4">Identitas Digital Perusahaan</h3>
                    <p class="text-gray-600 mt-1 max-w-xl mx-auto">Langkah pertama untuk memperluas jangkauan sistem dan kehadiran digital bisnis Anda.</p>
                </div>

                <div class="mt-12 max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 pt-6 px-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible">
                    @foreach ($domains as $d)
                        @php
                            $config = $d->discount_config['register'] ?? [];
                            $type   = $config['type'] ?? 'none';
                            $val    = $config['value'] ?? 0;
                            $label  = $config['label'] ?? '';

                            $final = $d->price;
                            $info  = ''; 
                            $isDisc = false;

                            if ($type == 'percent' && $val > 0) {
                                $final = $d->price - ($d->price * ($val / 100));
                                $info  = "Diskon $val%";
                                $isDisc = true;
                            } elseif ($type == 'fixed' && $val > 0) {
                                $final = $val;
                                $info  = "Harga Spesial";
                                $isDisc = ($final < $d->price);
                            }

                            $hasPromo = $isDisc || 
                                        (isset($d->discount_config['renew']['type']) && $d->discount_config['renew']['type'] !== 'none') || 
                                        (isset($d->discount_config['transfer']['type']) && $d->discount_config['transfer']['type'] !== 'none');
                        @endphp

                        <div class="flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 
                            {{ $hasPromo ? 'border-2 border-red-500 shadow-red-50' : ($d->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border border-gray-200 shadow-sm') }}">

                            @if ($hasPromo)
                                <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-red-600 to-red-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white">
                                    PROMO
                                </span>
                            @elseif($d->tag)
                                <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white">
                                    {{ $d->tag }}
                                </span>
                            @endif

                            <div class="text-center mt-2 pb-4 border-b border-gray-50">
                                <h4 class="font-extrabold text-3xl text-gray-800 transition group-hover:text-blue-600">{{ $d->name }}</h4>
                            </div>

                            <div class="flex-1 flex flex-col justify-center items-center py-6 space-y-2">
                                @if ($isDisc)
                                    @if($label)
                                        <span class="text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                            {{ $label }}
                                        </span>
                                    @else
                                        <div class="h-5"></div>
                                    @endif

                                    <div class="flex items-center justify-center gap-2">
                                        <span class="text-xs text-gray-400 line-through decoration-red-300">
                                            Rp {{ number_format($d->price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-[10px] font-semibold text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded">
                                            {{ $info }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <span class="text-3xl font-extrabold text-red-600 leading-none">
                                            Rp {{ number_format($final, 0, ',', '.') }}
                                        </span>
                                        <span class="text-[11px] text-gray-400 font-medium uppercase mt-1 tracking-wide">/tahun pertama</span>
                                    </div>
                                @else
                                    <div class="h-6"></div>
                                    
                                    <div class="flex flex-col items-center">
                                        <span class="text-3xl font-extrabold text-blue-600 leading-none">
                                            Rp {{ number_format($d->price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-[11px] text-gray-400 font-medium uppercase mt-1 tracking-wide">/tahun</span>
                                    </div>
                                    
                                    <div class="h-4"></div>
                                @endif
                            </div>

                            <div class="mt-auto">
                                <a href="{{ route('domain.registration.detail', ['tld' => strtolower($d->name)]) }}"
                                    class="block w-full py-3.5 rounded-xl font-bold text-center transition shadow-lg transform hover:-translate-y-0.5
                                    {{ $isDisc ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                                    Pilih {{ strtolower($d->name) }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- VPS CONTENT --}}
            <div data-content="vps" class="hidden">
                <div class="text-center mt-8 md:mt-12 px-4">
                    <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl">
                        <i class="ri-server-line text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mt-4">Infrastruktur Server & Cloud</h3>
                    <p class="text-gray-600 mt-1 max-w-xl mx-auto">Solusi Cloud Strategy untuk aplikasi Enterprise berskala besar</p>
                </div>
                
                <div class="mt-12 max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 pt-6 px-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible">
                    @foreach ($vps as $plan)
                        @php
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

                        <div class="flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 
                            {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($plan->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200 shadow-sm') }}">

                            <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
                                 {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($plan->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                                {{ $isPromo ? 'PROMO' : ($plan->tag ?? '') }}
                            </span>

                            <div class="text-center pb-4 border-b border-gray-50 mb-4">
                                <h4 class="font-extrabold text-2xl text-gray-800">{{ $plan->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Cloud VPS</p>
                            </div>

                            <div class="flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                @if ($isPromo && $promoLabel)
                                    <span class="text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                @else
                                    <div class="{{ $isPromo ? 'hidden' : 'h-5' }}"></div>
                                @endif

                                @if ($isPromo)
                                    <div class="flex items-center justify-center gap-2 text-xs">
                                        <span class="text-gray-400 line-through decoration-red-300">
                                            Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                        </span>
                                        <span class="text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                            {{ $promoInfo }}
                                        </span>
                                    </div>
                                @else
                                    <div class="h-4"></div>
                                @endif

                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span class="text-4xl font-extrabold tracking-tight leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-400">/bln</span>
                                </div>
                            </div>

                            <ul class="space-y-4 text-sm text-gray-600 mb-6">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1 bg-green-100 rounded-full shrink-0">
                                            <i class="ri-check-line text-green-600 text-xs font-bold"></i>
                                        </div>
                                        <span class="font-medium">{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-auto">
                                <a href="{{ route('vps.detail') }}"
                                    class="block w-full py-3.5 rounded-xl font-bold text-center transition shadow-lg transform hover:-translate-y-0.5
                                    {{ $isPromo ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CPANEL CONTENT --}}
            <div data-content="cpanel" class="hidden">
                <div class="text-center mt-8 md:mt-12 px-4">
                    <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl">
                        <i class="ri-settings-3-line text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mt-4">Web Hosting Terkelola</h3>
                    <p class="text-gray-600 mt-1 max-w-xl mx-auto">Pendekatan infrastruktur cerdas untuk aplikasi web Anda</p>
                </div>
                
                <div class="mt-12 max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-6 pt-6 px-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-8 md:px-4 md:pb-0 md:overflow-visible">
                    @foreach ($hostings as $h)
                        @php
                            $cycleKey = ($h->cycle == 'yr') ? 'annually' : 'monthly';
                            $cycleLabel = ($h->cycle == 'yr') ? '/thn' : '/bln';
                            $config = $h->discount_config[$cycleKey] ?? [];

                            $basePrice = $h->price;
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

                        <div class="flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-8 rounded-2xl relative flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 
                            {{ $isPromo ? 'border-2 border-red-500 shadow-red-50' : ($h->tag ? 'border-2 border-blue-500 shadow-blue-50' : 'border-2 border-gray-200 shadow-sm') }}">

                            <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md tracking-wider uppercase whitespace-nowrap z-20 border-2 border-white 
                                 {{ $isPromo ? 'bg-gradient-to-r from-red-600 to-red-500 text-white' : ($h->tag ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'hidden') }}">
                                {{ $isPromo ? 'PROMO' : ($h->tag ?? '') }}
                            </span>

                            <div class="text-center pb-4 border-b border-gray-50 mb-4">
                                <h4 class="font-extrabold text-2xl text-gray-800">{{ $h->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Shared Hosting</p>
                            </div>

                            <div class="flex flex-col items-center justify-center min-h-[110px] mb-6 space-y-1">
                                @if ($isPromo && $promoLabel)
                                    <span class="text-[10px] font-bold text-red-500 uppercase tracking-widest bg-red-50 px-2 py-1 rounded border border-red-100">
                                        {{ $promoLabel }}
                                    </span>
                                @else
                                    <div class="{{ $isPromo ? 'hidden' : 'h-5' }}"></div>
                                @endif

                                @if ($isPromo)
                                    <div class="flex items-center justify-center gap-2 text-xs">
                                        <span class="text-gray-400 line-through decoration-red-300">
                                            Rp {{ number_format($normalPrice, 0, ',', '.') }}
                                        </span>
                                        <span class="text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                            {{ $promoInfo }}
                                        </span>
                                    </div>
                                @else
                                    <div class="h-4"></div>
                                @endif

                                <div class="flex flex-row items-baseline justify-center gap-1 mt-1">
                                    <span class="text-lg font-bold text-gray-500">Rp</span>
                                    <span class="text-4xl font-extrabold tracking-tight leading-none {{ $isPromo ? 'text-red-600' : 'text-blue-600' }}">
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-400">{{ $cycleLabel }}</span>
                                </div>
                            </div>

                            <ul class="space-y-4 text-sm text-gray-600 mb-6">
                                @foreach ($h->features as $feature)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1 bg-green-100 rounded-full shrink-0">
                                            <i class="ri-check-line text-green-600 text-xs font-bold"></i>
                                        </div>
                                        <span class="font-medium">{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-auto">
                                <a href="{{ route('cpanel.detail') }}"
                                    class="block w-full py-3.5 rounded-xl font-bold text-center transition shadow-lg transform hover:-translate-y-0.5
                                    {{ $isPromo ? 'bg-red-600 text-white hover:bg-red-700 shadow-red-200' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-200' }}">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SAAS CONTENT --}}
            <div data-content="saas" class="hidden">
                <div class="text-center mt-8 md:mt-12 px-4">
                    <div
                        class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl">
                        <i class="ri-briefcase-3-line text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mt-4">SaaS & Business Tools</h3>
                    <p class="text-gray-600 mt-1 max-w-xl mx-auto">Software that works for your business. Mulai dari manajemen bisnis, produktivitas, hingga kreativitas.</p>
                </div>

                <div
                    class="mt-12 max-w-6xl mx-auto flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-4 pt-6 px-6 pb-8 scrollbar-hide md:grid md:grid-cols-3 md:gap-6 md:px-4 md:pb-0 md:overflow-visible">

                    @foreach ($saas as $s)
                        <div
                            class="flex-shrink-0 w-[85%] sm:w-[350px] md:w-auto snap-center bg-white p-6 rounded-2xl shadow border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative flex flex-col h-full">

                            <div class="h-40 w-full bg-gray-100 rounded-xl mb-4 overflow-hidden relative">
                                <img src="{{ asset($s->thumbnail) }}" alt="{{ $s->name }}"
                                    class="w-full h-full object-cover">
                                <span
                                    class="absolute top-2 right-2 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-700">
                                    {{ $s->category }}
                                </span>
                            </div>

                            <div class="flex-1">
                                <h4 class="font-bold text-xl text-gray-900 mb-1 line-clamp-1">{{ $s->name }}</h4>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $s->tagline }}</p>

                                <div class="flex items-baseline gap-1 text-blue-600">
                                    <span class="text-sm font-medium">Mulai</span>
                                    <span class="text-2xl font-extrabold">Rp
                                        {{ number_format($s->price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('saas.detail') }}"
                                class="block w-full mt-6 py-2 rounded-lg font-semibold border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition text-center">
                                Lihat Detail
                            </a>

                        </div>
                    @endforeach

                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('saas.detail') }}"
                        class="inline-flex items-center gap-2 text-blue-600 font-bold hover:underline">
                        Lihat Semua Aplikasi <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- MENGAPA MEMILIH KAMI (Our Technology Mindset) -->
    <section id="why-choose-us" class="scroll-reveal w-full py-20 bg-gray-900 text-white px-4 relative overflow-hidden">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-purple-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold">Our <span class="text-blue-400">Technology Mindset</span></h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Build for today, Design for tomorrow. Kami memilih dan mengimplementasikan teknologi berdasarkan landasan pola pikir yang memastikan keberlanjutan bisnis Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-focus-3-line"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Solusi Tepat Guna (Business Fit)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Kami merancang perangkat lunak dan arsitektur sebagai solusi untuk masalah nyata, difokuskan pada kebutuhan spesifik dan operasional bisnis Anda yang unik.</p>
                </div>

                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-shield-check-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Keamanan Maksimal (Security)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Infrastruktur dan kode kami dirancang dengan mitigasi tinggi untuk melindungi data serta sistem enterprise Anda agar selalu aman dan terkendali.</p>
                </div>

                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-heart-pulse-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Fokus Pengguna (User Value)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Menghadirkan pengalaman interaksi (UI/UX) yang lebih baik, intuitif, dan bermakna agar adopsi sistem oleh karyawan maupun pelanggan Anda berjalan mulus.</p>
                </div>
                
                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-tools-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kemudahan Pemeliharaan (Maintainability)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Seluruh arsitektur sistem dibangun dengan praktik standar industri agar mudah dikembangkan lebih lanjut, dipelihara, dan diintegrasikan di masa mendatang.</p>
                </div>

                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-arrow-up-circle-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Skalabilitas Tinggi (Scalability)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Infrastruktur dan aplikasi dirancang khusus untuk memiliki skalabilitas optimal, memastikan teknologi mampu tumbuh bersamaan dengan peningkatan trafik bisnis Anda.</p>
                </div>

                <div class="bg-gray-800/50 backdrop-blur border border-gray-700 p-8 rounded-2xl hover:border-blue-500 transition duration-300">
                    <div class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-2xl mb-6">
                        <i class="ri-pie-chart-box-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Efisiensi Biaya (Cost Efficiency)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Memberikan nilai terukur yang sebanding dengan investasi teknologi yang Anda keluarkan, berpegang pada prinsip *Value of Money* untuk optimasi keuangan korporat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <section class="scroll-reveal w-full py-20 bg-gray-50 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Dipercaya oleh <span class="text-blue-600">Pelanggan Kami</span></h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Apa kata mereka yang telah mengembangkan bisnisnya bersama solusi digital terintegrasi dari PT Berkah Teknologi Terdepan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testi)
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative">
                    <div class="text-blue-500 text-4xl absolute top-6 right-8 opacity-20"><i class="ri-double-quotes-r"></i></div>
                    <div class="flex gap-1 text-yellow-400 text-sm mb-4">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $testi->rating)
                                <i class="ri-star-fill"></i>
                            @else
                                <i class="ri-star-line"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed italic mb-6">"{{ $testi->comment }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">
                            {{ strtoupper(substr($testi->user->name ?? 'User', 0, 2)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $testi->user->name ?? 'Pengguna Anonim' }}</h4>
                            <p class="text-xs text-gray-500">Partner Bisnis</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ (Frequently Asked Questions) -->
    <section class="scroll-reveal w-full py-20 bg-white px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Pertanyaan yang Sering <span class="text-blue-600">Diajukan (FAQ)</span></h2>
                <p class="text-gray-600 mt-4">Temukan jawaban cepat untuk pertanyaan umum seputar kapabilitas digital kami.</p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                <!-- FAQ 1 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white transition hover:border-blue-300">
                    <button @click="active = active === 1 ? null : 1" class="w-full flex items-center justify-between p-5 text-left font-semibold text-gray-800 hover:text-blue-600 transition">
                        <span>Apa saja layanan utama dari PT Berkah Teknologi Terdepan?</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-300 text-xl" :class="active === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak>
                        <div class="p-5 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            Kami memiliki empat pilar utama: 1) Custom Software (Web, Mobile, Desktop, API), 2) Layanan SaaS (seperti smartrack.id dan scanyuk.com), 3) Consulting (Manajemen dan Digital Transformation), serta 4) Enterprise System (ERP untuk HRMS, CRM, Finance, Inventory).
                        </div>
                    </div>
                </div>
                <!-- FAQ 2 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white transition hover:border-blue-300">
                    <button @click="active = active === 2 ? null : 2" class="w-full flex items-center justify-between p-5 text-left font-semibold text-gray-800 hover:text-blue-600 transition">
                        <span>Bagaimana pendekatan Anda dalam pengembangan Custom Software?</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-300 text-xl" :class="active === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak>
                        <div class="p-5 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            Kami menerapkan pendekatan berstandar industri mulai dari fase Understand (memahami proses bisnis Anda), Design (merancang solusi), Build, Validate, Launch, hingga Improve. Semuanya demi mencapai skalabilitas dan performa maksimal.
                        </div>
                    </div>
                </div>
                <!-- FAQ 3 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white transition hover:border-blue-300">
                    <button @click="active = active === 3 ? null : 3" class="w-full flex items-center justify-between p-5 text-left font-semibold text-gray-800 hover:text-blue-600 transition">
                        <span>Apakah Anda melayani konsultasi penerapan KPI dan strategi transformasi digital?</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-300 text-xl" :class="active === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak>
                        <div class="p-5 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            Tentu! Melalui divisi Consulting kami, kami tidak hanya mengurus kode, namun membantu organisasi Anda menetapkan Project Management, Framework OKR/KPI, Digital Transformation (Process Digitalization), hingga integrasi teknologi secara menyeluruh.
                        </div>
                    </div>
                </div>
                <!-- FAQ 4 -->
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white transition hover:border-blue-300">
                    <button @click="active = active === 4 ? null : 4" class="w-full flex items-center justify-between p-5 text-left font-semibold text-gray-800 hover:text-blue-600 transition">
                        <span>Apa itu produk SaaS Smartrack.id dan Scanyuk.com?</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-300 text-xl" :class="active === 4 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 4" x-collapse x-cloak>
                        <div class="p-5 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            Ini adalah bagian dari layanan SaaS kami. Smartrack.id merupakan platform Business Tool untuk membantu manajemen aktivitas dan produktivitas operasional, sedangkan Scanyuk.com memfasilitasi kebutuhan kreatif digital Anda secara praktis dan accessible.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRE-FOOTER SEO TEXT -->
    <section class="scroll-reveal w-full py-12 bg-gray-50 border-t border-gray-200 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-sm font-bold text-gray-800 uppercase tracking-widest mb-4">Layanan Teknologi & Ekosistem Digital</h2>
            <div class="text-xs text-gray-500 leading-relaxed space-y-3 text-justify">
                <p>
                    PT Berkah Teknologi Terdepan (FutureCloud.id) adalah mitra transformasi bisnis Anda yang menyediakan integrasi teknologi menyeluruh. Kami menghadirkan solusi berupa <strong>Custom Software Development</strong> seperti Web Application, Mobile Apps, dan Enterprise API. Kami memahami bahwa software yang hebat harus direkayasa khusus mengikuti kebutuhan, proses bisnis, serta target organisasi di era modern.
                </p>
                <p>
                    Lebih dari sekadar pengembangan aplikasi, kami menyajikan ekosistem <strong>SaaS (Software as a Service)</strong> unggulan seperti <em>Smartrack.id</em> untuk menunjang aktivitas manajerial dan operasional bisnis, serta <em>Scanyuk.com</em> sebagai platform yang memudahkan inovasi kreatif digital perusahaan Anda. Semuanya dibangun dengan mindset *Business Fit*, keamanan tangguh, dan skalabilitas tinggi di atas arsitektur cloud terkelola kami.
                </p>
                <p>
                    Untuk memastikan implementasi yang tepat sasaran, divisi <strong>Management & Digital Consulting</strong> kami siap mendampingi eksekutif dalam merumuskan strategi perusahaan, implementasi kerangka kerja OKR, penentuan KPI, hingga integrasi kecerdasan buatan (AI Coding & Development). Kami juga menawarkan kapabilitas sistem <strong>ERP (Enterprise Resource Planning)</strong> lengkap mulai dari HRMS, CRM, Finance, hingga Supply Chain Management yang menghubungkan orang, sistem, dan data dalam satu payung digital secara efektif dan efisien.
                </p>
            </div>
        </div>
    </section>

    <section id="contact" class="scroll-reveal w-full py-16 px-4">
        <div
            class="max-w-4xl mx-auto bg-white p-6 md:p-10 rounded-2xl shadow border text-center hover:shadow-xl transition">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Siap untuk Memulai Transformasi?</h2>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <button
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow flex items-center justify-center gap-2 hover:bg-blue-700 transition w-full sm:w-auto"
                    onclick="window.location='{{ route('contact') }}'">Hubungi Kami <i
                        class="ri-arrow-right-line"></i></button>
            </div>
        </div>
    </section>

    {{-- PROMO BANNER POPUP --}}
    @if(isset($hero) && $hero->is_promo_active && !empty($hero->promo_image))
    <!-- (Kode Promo Popup Tetap Sama) -->
    <div x-data="{ 
            showPromo: false,
            init() {
                if(!sessionStorage.getItem('promo_closed')) {
                    setTimeout(() => { this.showPromo = true; }, 800);
                }
            },
            closePromo() {
                this.showPromo = false;
                sessionStorage.setItem('promo_closed', 'true');
            }
         }"
         x-show="showPromo" 
         x-cloak
         x-transition.opacity.duration.500ms
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
         style="display: none;">
         
         {{-- Backdrop --}}
         <div class="absolute inset-0 cursor-pointer" @click="closePromo()"></div>

         {{-- Modal --}}
         <div class="relative z-10 w-full max-w-md bg-transparent rounded-2xl shadow-2xl transform transition-all"
              x-show="showPromo"
              x-transition:enter="transition ease-out duration-500 delay-100"
              x-transition:enter-start="opacity-0 translate-y-8 scale-95"
              x-transition:enter-end="opacity-100 translate-y-0 scale-100"
              x-transition:leave="transition ease-in duration-300"
              x-transition:leave-start="opacity-100 translate-y-0 scale-100"
              x-transition:leave-end="opacity-0 translate-y-8 scale-95">
             
             <button @click="closePromo()" class="absolute -top-4 -right-4 w-9 h-9 flex items-center justify-center bg-white text-gray-900 rounded-full hover:bg-gray-100 hover:text-red-500 shadow-lg transition z-20">
                 <i class="ri-close-line text-xl font-bold"></i>
             </button>

             @if($hero->promo_url)
                 <a href="{{ $hero->promo_url }}" class="block w-full h-full relative group overflow-hidden rounded-2xl">
                     <img src="{{ asset('storage/' . $hero->promo_image) }}" alt="Promo Spesial" class="w-full h-auto object-cover rounded-2xl group-hover:scale-[1.02] transition duration-500">
                     <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition duration-300"></div>
                 </a>
             @else
                 <div class="block w-full h-full relative rounded-2xl overflow-hidden">
                     <img src="{{ asset('storage/' . $hero->promo_image) }}" alt="Promo Spesial" class="w-full h-auto object-cover rounded-2xl">
                 </div>
             @endif
         </div>
    </div>
    @endif

    <script>
        class HomeController {
            constructor() {
                this.input = document.getElementById('domain-search-input');
                this.checkButton = document.getElementById('check-domain-button');
                this.resultDiv = document.getElementById('availability-result');
                this.mainContainer = document.getElementById('main-result-container');
                this.altWrapper = document.getElementById('alternatives-wrapper');
                this.altContainer = document.getElementById('alternatives-list-container');

                this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                this.cartUrl = "{{ route('cart.add') }}";

                this.bindEvents();
                this.bindExtensionTags();
            }

            bindEvents() {
                if (this.checkButton) {
                    this.checkButton.addEventListener('click', () => this.checkDomain());
                    this.input.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') this.checkDomain();
                    });
                }
            }

            bindExtensionTags() {
                document.querySelectorAll('.domain-extension-tag').forEach(tag => {
                    tag.addEventListener('click', () => {
                        let cv = this.input.value.trim();
                        if (cv.includes('.')) cv = cv.split('.')[0];
                        this.input.value = cv + tag.getAttribute('data-extension');
                        this.input.focus();
                    });
                });
            }

            createRowHtml(item, isMain = false) {
                const isAvailable = item.available;
                const statusColor = isAvailable ? 'bg-green-100 text-green-700 border-green-200' :
                    'bg-red-100 text-red-700 border-red-200';
                const icon = isAvailable ? 'ri-checkbox-circle-fill text-green-500' :
                    'ri-close-circle-fill text-red-500';
                const statusText = isAvailable ? 'Tersedia' : 'Sudah Terdaftar';

                let priceHtml = '';
                if (item.is_discounted) {
                    priceHtml = `
                    <div class="flex flex-col items-end">
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-red-100 text-red-600 px-1.5 rounded font-bold">HEMAT ${item.save_percent}%</span>
                            <span class="text-xs text-gray-400 line-through">Rp ${item.formatted_original}</span>
                        </div>
                        <div class="text-lg font-bold text-red-600">Rp ${item.formatted_price}</div>
                        <div class="text-xs text-gray-400">/tahun pertama</div>
                    </div>
                `;
                } else {
                    priceHtml = `
                    <div class="text-right">
                        <div class="text-lg font-bold text-blue-600">Rp ${item.formatted_price}</div>
                        <div class="text-xs text-gray-400">/tahun</div>
                    </div>
                `;
                }

                let actionHtml = '';
                if (isAvailable) {
                    actionHtml = `
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto mt-3 sm:mt-0">
                        ${priceHtml}
                        <form action="${this.cartUrl}" method="POST" class="w-full sm:w-auto">
                            <input type="hidden" name="_token" value="${this.csrfToken}">
                            <input type="hidden" name="product_name" value="${item.domain}">
                            <input type="hidden" name="price" value="${item.price_final}">
                            <input type="hidden" name="type" value="domain">
                            <input type="hidden" name="cycle" value="1 Year(s)">
                            <input type="hidden" name="years" value="1">
                            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm flex items-center justify-center gap-2">
                                <i class="ri-shopping-cart-2-line"></i> Daftar
                            </button>
                        </form>
                    </div>
                `;
                } else {
                    actionHtml = `
                    <div class="mt-2 sm:mt-0 flex flex-col sm:items-end">
                        <button class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-sm font-semibold cursor-not-allowed border border-gray-200" disabled>
                            Tidak Tersedia
                        </button>
                        <a href="https://www.whois.com/whois/${item.domain}" target="_blank" class="text-xs text-blue-500 hover:underline block mt-1">Cek Whois</a>
                    </div>
                `;
                }

                const bgClass = isMain ? 'bg-white p-6' :
                    'bg-white p-4 border-b border-gray-100 hover:bg-gray-50 transition';

                return `
                <div class="${bgClass} flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <i class="${icon} text-3xl flex-shrink-0"></i>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 break-all">${item.domain}</h3>
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold border ${statusColor} mt-1">
                                ${statusText}
                            </span>
                        </div>
                    </div>
                    ${actionHtml}
                </div>
            `;
            }

            async checkDomain() {
                const domain = this.input.value.trim().toLowerCase();

                this.resultDiv.classList.remove('hidden');
                this.altWrapper.classList.add('hidden');
                this.mainContainer.innerHTML = '';

                if (!domain) {
                    this.mainContainer.innerHTML =
                        `<div class="p-6 text-center text-yellow-600 bg-yellow-50">Mohon masukkan nama identitas digital.</div>`;
                    return;
                }
                if (!domain.includes('.')) {
                    this.input.value = domain + '.com';
                }

                this.checkButton.disabled = true;
                this.checkButton.innerHTML = `<i class="ri-loader-4-line animate-spin"></i> Memproses...`;

                this.mainContainer.innerHTML = `
                <div class="p-8 text-center text-gray-500 loading-pulse">
                    <i class="ri-earth-line text-4xl text-blue-300"></i>
                    <p class="mt-3 font-medium text-lg">Sedang memverifikasi ketersediaan...</p>
                </div>
            `;

                try {
                    const response = await fetch('/check-domain-availability', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            domain: this.input.value
                        })
                    });

                    const data = await response.json();

                    if (data.error) {
                        this.mainContainer.innerHTML =
                            `<div class="p-6 text-center text-red-500 bg-red-50"><i class="ri-error-warning-line text-3xl mb-2"></i><br>${data.message}</div>`;
                    } else {
                        if (data.main) {
                            this.mainContainer.innerHTML = this.createRowHtml(data.main, true);
                        }
                        if (data.alternatives && data.alternatives.length > 0) {
                            this.altWrapper.classList.remove('hidden');
                            this.altContainer.innerHTML = data.alternatives.map(item => this.createRowHtml(item, false))
                                .join('');
                        }
                    }
                } catch (e) {
                    this.mainContainer.innerHTML =
                        `<div class="p-6 text-center text-red-700 bg-red-100">Gagal terhubung ke server. Silakan coba lagi.</div>`;
                } finally {
                    this.checkButton.disabled = false;
                    this.checkButton.innerHTML = `Cek Ketersediaan`;
                }
            }
        }

        window.onload = () => {
            window.homeController = new HomeController();
        };

        // TAB SWITCHER
        const tabs = document.querySelectorAll('.tab-item');
        const contents = document.querySelectorAll('[data-content]');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('bg-white', 'shadow-md', 'text-gray-900', 'font-semibold');
                    t.classList.add('text-gray-500', 'hover:text-gray-900', 'font-medium');
                });
                tab.classList.remove('text-gray-500', 'hover:text-gray-900', 'font-medium');
                tab.classList.add('bg-white', 'shadow-md', 'text-gray-900', 'font-semibold');
                const selected = tab.getAttribute('data-tab');
                contents.forEach(c => c.classList.add('hidden'));
                document.querySelector(`[data-content="${selected}"]`).classList.remove('hidden');
            });
        });
    </script>
@endsection