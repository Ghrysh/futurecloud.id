@extends('layouts.landing')

@section('title', 'Domain Registration - FutureCloud.id')

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

        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }

        /* Smooth category transition - Style tombol filter mirip switcher pricing */
        .cat-btn { transition: all 0.3s ease; }
        .cat-btn.active { background-color: #2563EB; color: white; border-color: #2563EB; }
    </style>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-purple-500 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-6xl mx-auto relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wider mb-4 uppercase">FutureCloud Domains</span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                Cari Nama <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Domain Impian</span>
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed px-2 font-light">
                Amankan identitas digital bisnis Anda sekarang. Mulai pencarian domain Anda di bawah ini.
            </p>

            {{-- SEARCH CONTAINER --}}
            <div class="mt-10 w-full px-0 md:px-4 relative z-10" id="search-container">
                <div id="domain-search-form" class="flex flex-col sm:flex-row items-center gap-2 p-2 rounded-2xl shadow-2xl w-full max-w-2xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 focus-within:ring-4 focus-within:ring-blue-500/50 transition-all">
                    <div class="flex items-center w-full sm:flex-1 p-3 bg-white rounded-xl">
                        <i class="ri-search-2-line text-xl md:text-2xl text-blue-600 mr-3"></i>
                        <input type="text" id="domain-input" placeholder="Ketik nama domain (contoh: bisnisku)..."
                            class="flex-1 outline-none py-1 text-sm md:text-lg w-full placeholder:text-gray-400 text-gray-800 font-semibold"
                            autocomplete="off" />
                    </div>
                    <button id="check-domain-button"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-sm md:text-base hover:bg-blue-700 transition flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed shadow-lg">
                        <span>Cari Domain</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- RESULT SECTION --}}
    <section id="result-section" class="w-full py-12 px-4 bg-white border-b border-gray-100 hidden min-h-[100px]">
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4 font-bold text-lg flex items-center gap-2">
                    <i class="ri-search-eye-line"></i> Hasil Pencarian Utama
                </div>
                <div id="main-result-container"></div>
            </div>
            <div id="alternatives-wrapper" class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hidden">
                <div class="bg-gray-50 text-gray-800 px-6 py-4 font-bold text-lg flex items-center gap-2 border-b border-gray-200">
                    <i class="ri-lightbulb-flash-line text-yellow-500"></i> Rekomendasi Alternatif Tersedia
                </div>
                <div id="alternatives-list-container"></div>
            </div>
        </div>
    </section>

    {{-- FEATURED EXTENSIONS (UPDATED CARD STYLE) --}}
    <section class="w-full py-16 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Ekstensi Populer</h2>
                <p class="text-gray-500">Pilihan ekstensi domain terlaris dengan penawaran terbaik.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($featuredDomains as $d)
                    @php
                        // --- LOGIC HITUNG HARGA REGISTER ---
                        $config = $d->discount_config['register'] ?? [];
                        $type   = $config['type'] ?? 'none';
                        $val    = $config['value'] ?? 0;
                        $label  = $config['label'] ?? ''; // Label Acara (ex: OFF 1ST YEAR)

                        $final = $d->price;
                        $info  = ''; // Info Tipe (ex: Diskon 50%)
                        $isDisc = false;

                        if($type == 'percent' && $val > 0) {
                            $final = $d->price - ($d->price * ($val/100));
                            $info  = "$val%";
                            $isDisc = true;
                        } elseif($type == 'fixed' && $val > 0) {
                            $final = $val;
                            $info  = "Harga Spesial";
                            $isDisc = ($final < $d->price);
                        }
                        
                        // Cek apakah ada promo global (untuk badge)
                        $hasPromo = $isDisc || 
                                    (isset($d->discount_config['renew']['type']) && $d->discount_config['renew']['type'] !== 'none') ||
                                    (isset($d->discount_config['transfer']['type']) && $d->discount_config['transfer']['type'] !== 'none');
                    @endphp

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center relative hover:shadow-xl hover:-translate-y-1 transition duration-300 cursor-pointer domain-ext-card group flex flex-col justify-between h-full"
                         data-ext="{{ strtolower($d->name) }}">
                        
                        {{-- 1. BADGE KIRI ATAS (PROMO / TAG) --}}
                        @if ($hasPromo)
                            <span class="absolute top-0 left-0 bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-br-lg z-10 shadow-sm tracking-wide">
                                PROMO
                            </span>
                        @elseif($d->tag)
                            <span class="absolute top-0 left-0 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-br-lg z-10 shadow-sm tracking-wide">
                                {{ $d->tag }}
                            </span>
                        @endif

                        {{-- 2. NAMA DOMAIN --}}
                        <div class="mt-4 mb-2">
                            <h3 class="font-extrabold text-2xl text-gray-800 group-hover:text-blue-600 transition">
                                {{ $d->name }}
                            </h3>
                        </div>

                        {{-- 3. AREA HARGA --}}
                        <div class="flex-1 flex flex-col justify-center items-center space-y-1 mb-2">
                            @if ($isDisc)
                                {{-- A. Label Acara (OFF 1ST YEAR) --}}
                                @if($label)
                                    <span class="text-[10px] font-bold text-red-500 uppercase tracking-wide">
                                        {{ $label }}
                                    </span>
                                @else
                                    <div class="h-4"></div> {{-- Spacer jika tidak ada label --}}
                                @endif

                                {{-- B. Harga Coret + Info Tipe --}}
                                <div class="flex items-center justify-center gap-2 text-xs">
                                    <span class="text-gray-400 line-through">
                                        Rp {{ number_format($d->price, 0, ',', '.') }}
                                    </span>
                                    {{-- Tipe Promo (Diskon 50% / Harga Spesial) --}}
                                    <span class="text-gray-500 font-semibold text-[10px] border border-gray-200 px-1 rounded bg-gray-50">
                                        {{ $info }}
                                    </span>
                                </div>

                                {{-- C. Harga Jadi (Merah Besar) --}}
                                <div class="text-xl font-extrabold text-red-600">
                                    Rp {{ number_format($final, 0, ',', '.') }}
                                </div>
                            @else
                                {{-- Tampilan Normal --}}
                                <div class="h-6"></div> {{-- Spacer atas --}}
                                <div class="text-xl font-extrabold text-blue-600">
                                    Rp {{ number_format($d->price, 0, ',', '.') }}
                                </div>
                                <div class="h-4"></div> {{-- Spacer bawah --}}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRICING TABLE SECTION --}}
    <section class="py-20 px-4 bg-white" id="pricing-table">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
                    Cek Harga Domain <span class="text-blue-600">Impianmu</span>
                </h2>
                <p class="text-gray-600 text-sm md:text-base max-w-2xl mx-auto">
                    Gunakan alat pencarian harga domain kami di bawah ini untuk menemukan biaya domain populer hingga 10 tahun ke depan.
                </p>
            </div>

            {{-- CATEGORY FILTER --}}
            <div class="mb-8 relative">
                <div class="flex overflow-x-auto gap-2 pb-4 scrollbar-hide px-4 justify-start" id="category-filter">
                    {{-- TOMBOL POPULER --}}
                    <button onclick="filterCategory('Popular')" 
                        class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-blue-600 bg-blue-600 text-white active flex-shrink-0" 
                        data-cat="Popular">Populer 🔥</button>

                    {{-- TOMBOL SEMUA --}}
                    <button onclick="filterCategory('all')" 
                        class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 hover:bg-gray-100 flex-shrink-0" 
                        data-cat="all">Semua</button>

                    {{-- LOOP KATEGORI LAIN --}}
                    @foreach ($categories as $cat)
                        @if($cat != 'Popular') 
                        <button onclick="filterCategory('{{ $cat }}')" 
                            class="cat-btn px-6 py-2 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 hover:bg-gray-100 flex-shrink-0" 
                            data-cat="{{ $cat }}">{{ $cat }}</button>
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

    {{-- CTA FOOTER --}}
    <section class="w-full py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto bg-blue-600 rounded-3xl p-10 md:p-16 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap untuk Online?</h2>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="#" onclick="document.getElementById('domain-input').focus(); window.scrollTo({top: 0, behavior: 'smooth'});" class="px-8 py-3 bg-white text-blue-700 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">Cari Domain</a>
                </div>
            </div>
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-500 rounded-full opacity-50 blur-3xl"></div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const domainInput = document.getElementById('domain-input');
            const checkButton = document.getElementById('check-domain-button');
            const resultSection = document.getElementById('result-section');
            const mainContainer = document.getElementById('main-result-container');
            const altWrapper = document.getElementById('alternatives-wrapper');
            const altContainer = document.getElementById('alternatives-list-container');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // 1. PRE-FILL dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const prefillTld = urlParams.get('tld');
            if (prefillTld) {
                domainInput.value = prefillTld.toLowerCase();
                domainInput.focus();
            }

            // 2. LOGIC KLIK CARD EKSTENSI POPULER (FITUR BARU)
            document.querySelectorAll('.domain-ext-card').forEach(card => {
                card.addEventListener('click', function() {
                    const ext = this.getAttribute('data-ext'); // misal: .com
                    const searchForm = document.getElementById('domain-search-form');

                    // A. Scroll ke Search Form
                    searchForm.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    // B. Manipulasi Input Text
                    let currentVal = domainInput.value.trim();
                    
                    // Jika sudah ada titik (ekstensi lain), buang ekstensinya
                    if(currentVal.indexOf('.') !== -1) {
                        currentVal = currentVal.substring(0, currentVal.indexOf('.'));
                    }

                    // Gabungkan nama + ekstensi baru
                    domainInput.value = currentVal + ext;
                    
                    // C. Focus ke Input
                    domainInput.focus();

                    // D. UX: Jika nama domain kosong (cuma ada .com), taruh kursor di paling depan
                    if(currentVal === '') {
                        domainInput.setSelectionRange(0, 0);
                    }
                    
                    // E. Efek Visual Ring di Input (Optional)
                    searchForm.classList.add('ring-4', 'ring-blue-500/30');
                    setTimeout(() => searchForm.classList.remove('ring-4', 'ring-blue-500/30'), 800);
                });
            });

            // 3. FUNGSI RENDER HTML BARIS TABEL
            function createRowHtml(item, isMain = false) {
                const isAvailable = item.available;
                const statusColor = isAvailable ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200';
                const statusText = isAvailable ? 'Tersedia' : 'Sudah Terdaftar';
                
                let priceHtml = '';
                if (item.is_discounted) {
                    let labelHtml = item.promo_label ? `<span class="text-[10px] font-bold text-red-500 uppercase border border-red-200 px-1 rounded ml-2">${item.promo_label}</span>` : '';
                    
                    priceHtml = `
                    <div class="flex flex-col items-end">
                        <div class="flex items-center">
                            <span class="text-xs bg-red-100 text-red-600 px-1.5 rounded font-bold mr-2">HEMAT ${item.save_percent}%</span>
                            <span class="text-xs text-gray-400 line-through">Rp ${item.formatted_original}</span>
                            ${labelHtml}
                        </div>
                        <div class="text-xl font-extrabold text-blue-600">Rp ${item.formatted_price}</div>
                        <div class="text-xs text-gray-500 font-medium">/tahun pertama</div>
                    </div>`;
                } else {
                    priceHtml = `
                    <div class="text-right">
                        <div class="text-xl font-extrabold text-blue-600">Rp ${item.formatted_price}</div>
                        <div class="text-xs text-gray-500 font-medium">/tahun</div>
                    </div>`;
                }

                let actionHtml = isAvailable ? 
                    `<div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto mt-4 sm:mt-0">
                        ${priceHtml}
                        <form method="POST" action="{{ route('cart.add') }}" class="flex items-center gap-2 m-0" onsubmit="this.price.value = ${item.price_final} * this.years.value;">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="type" value="domain">
                            <input type="hidden" name="product_name" value="${item.domain}">
                            <input type="hidden" name="price" value="${item.price_final}">
                            <input type="hidden" name="action" value="register">
                            
                            <select name="years" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none font-medium w-28">
                                <option value="1">1 Tahun</option>
                                <option value="2">2 Tahun</option>
                                <option value="3">3 Tahun</option>
                                <option value="5">5 Tahun</option>
                                <option value="10">10 Tahun</option>
                            </select>

                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition flex items-center gap-2 shadow-sm cursor-pointer border-none outline-none">
                                <i class="ri-shopping-cart-2-line"></i> Beli
                            </button>
                        </form>
                    </div>` : 
                    `<div class="mt-2 sm:mt-0 flex flex-col sm:items-end">
                        <button class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-sm font-semibold cursor-not-allowed border border-gray-200" disabled>Tidak Tersedia</button>
                    </div>`;

                const bgClass = isMain ? 'bg-white p-6' : 'bg-white p-5 border-b border-gray-100 hover:bg-blue-50/50 transition';

                return `
                <div class="${bgClass} flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0"><i class="${isAvailable ? 'ri-checkbox-circle-fill text-green-500' : 'ri-close-circle-fill text-red-500'} text-3xl"></i></div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 break-all">${item.domain}</h3>
                            <span class="inline-block px-3 py-1 rounded text-xs font-bold border ${statusColor} mt-1">${statusText}</span>
                        </div>
                    </div>
                    ${actionHtml}
                </div>`;
            }

            // 4. AJAX CEK DOMAIN
            async function checkDomains() {
                let domain = domainInput.value.trim().toLowerCase();
                if (!domain) { customAlert("Mohon masukkan nama domain!"); return; }
                if (!domain.includes('.')) { domain += '.com'; domainInput.value = domain; }

                resultSection.classList.remove('hidden');
                altWrapper.classList.add('hidden');
                checkButton.disabled = true;
                checkButton.innerHTML = `<i class="ri-loader-4-line animate-spin"></i> Memproses...`;
                mainContainer.innerHTML = `<div class="p-10 text-center text-gray-500 loading-pulse"><p class="font-bold text-lg">Sedang memeriksa...</p></div>`;

                try {
                    const response = await fetch('/check-domain-availability', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        body: JSON.stringify({ domain: domain })
                    });
                    const data = await response.json();

                    if (data.error) mainContainer.innerHTML = `<div class="p-6 text-center text-red-500 bg-red-50">${data.message}</div>`;
                    else {
                        if (data.main) mainContainer.innerHTML = createRowHtml(data.main, true);
                        if (data.alternatives && data.alternatives.length > 0) {
                            altWrapper.classList.remove('hidden');
                            altContainer.innerHTML = data.alternatives.map(item => createRowHtml(item, false)).join('');
                        }
                    }
                } catch (e) {
                    mainContainer.innerHTML = `<div class="p-6 text-center text-red-500">Terjadi kesalahan koneksi.</div>`;
                } finally {
                    checkButton.disabled = false;
                    checkButton.innerHTML = `<span>Cari Domain</span>`;
                }
            }

            checkButton.addEventListener('click', checkDomains);
            domainInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') checkDomains(); });

            // 5. FILTER KATEGORI (TABLE)
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
                const url = new URL("{{ route('domain.registration.detail') }}");
                url.searchParams.set('category', category);
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('table-content').innerHTML = html;
                })
                .finally(() => document.getElementById('table-loading').classList.add('hidden'));
            };
            
            // 6. Pagination Handler
            function attachTableListeners() {
                 const links = document.querySelectorAll('#ajax-pagination-links a');
                 links.forEach(link => {
                     link.addEventListener('click', function(e) {
                         e.preventDefault();
                         document.getElementById('table-loading').classList.remove('hidden');
                         fetch(this.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                         .then(res => res.text())
                         .then(html => {
                             document.getElementById('table-content').innerHTML = html;
                             attachTableListeners();
                         })
                         .finally(() => document.getElementById('table-loading').classList.add('hidden'));
                     });
                 });
            }
            attachTableListeners();
        });
    </script>
@endsection