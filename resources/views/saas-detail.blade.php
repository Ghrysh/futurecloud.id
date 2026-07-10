@extends('layouts.landing')

@section('title', 'SaaS Marketplace - FutureCloud.id')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Utility untuk JS Filter */
        .hidden-card { display: none !important; }
        
        /* Smooth transition for filter buttons */
        .category-btn { transition: all 0.3s ease; }
        
        /* Hover effect for cards */
        .saas-card:hover .card-img { transform: scale(1.05); }
    </style>
@endsection

@section('content')

    {{-- 1. HERO SECTION (Updated Style) --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-cyan-500 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-5xl mx-auto relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wider mb-4 uppercase">FutureCloud Marketplace</span>
            
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Aplikasi SaaS Terbaik<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Untuk Bisnis Anda</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl mb-10 font-light max-w-2xl mx-auto leading-relaxed px-4">
                Jelajahi ribuan aplikasi berkualitas, baca review jujur, dan berlangganan dengan mudah dalam satu platform.
            </p>

            {{-- Search Bar (Modern Glass Style) --}}
            <div class="mt-8 w-full px-0 md:px-4 relative z-10">
                <div class="flex flex-col sm:flex-row items-center gap-2 p-2 rounded-2xl shadow-2xl w-full max-w-2xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 focus-within:ring-4 focus-within:ring-blue-500/50 transition-all">
                    <div class="flex items-center w-full sm:flex-1 p-3 bg-white rounded-xl">
                        <i class="ri-search-2-line text-xl md:text-2xl text-blue-600 mr-3"></i>
                        <input type="text" id="saas-search-input" placeholder="Cari aplikasi (contoh: accounting, crm)..." 
                            class="flex-1 outline-none py-1 text-sm md:text-lg w-full placeholder:text-gray-400 text-gray-800 font-semibold bg-transparent" 
                            autocomplete="off">
                    </div>
                    {{-- Desktop Button --}}
                    <button class="hidden md:flex w-auto px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition items-center justify-center gap-2 shadow-lg">
                        <span>Cari</span>
                    </button>
                    {{-- Mobile Button (Icon Only) --}}
                    <button class="md:hidden w-full py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center shadow-lg">
                        <i class="ri-search-line mr-1"></i> Cari
                    </button>
                </div>
            </div>

            {{-- Filter Kategori --}}
            <div class="mt-10 flex flex-wrap justify-center gap-3 px-2" id="category-filter-container">
                @php $categories = ['All', 'Security', 'Productivity', 'Marketing', 'Sales', 'HR', 'Finance', 'Plugin']; @endphp
                @foreach ($categories as $index => $cat)
                    <button class="category-btn px-5 py-2 rounded-full text-sm font-medium border border-blue-500/30 hover:bg-blue-600 hover:text-white hover:border-transparent transition backdrop-blur-sm cursor-pointer
                        {{ $index === 0 ? 'bg-blue-600 text-white shadow-md border-transparent' : 'text-blue-200 bg-blue-900/30' }}"
                        data-category="{{ $cat }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 2. GRID APLIKASI --}}
    <section class="w-full py-16 md:py-24 px-4 bg-gray-50 min-h-screen border-t border-gray-200 rounded-t-[3rem] -mt-10 relative z-20">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col sm:flex-row justify-between items-end mb-10 gap-4 px-2">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Aplikasi Populer</h2>
                    <p class="text-gray-500 mt-2">Solusi terpercaya pilihan ribuan pengguna FutureCloud.</p>
                </div>
                {{-- Optional: View All Link --}}
            </div>

            {{-- Pesan Tidak Ada Hasil --}}
            <div id="no-results-message" class="hidden text-center py-24 bg-white rounded-2xl border border-gray-200">
                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-search-eye-line text-4xl text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Tidak ditemukan</h3>
                <p class="text-gray-500 mt-2">Coba kata kunci lain atau ubah filter kategori.</p>
                <button id="reset-filter-btn" class="mt-6 px-6 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Reset Pencarian
                </button>
            </div>

            {{-- GRID APLIKASI --}}
            <div id="saas-grid" class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                
                @foreach ($apps as $app)
                    <div onclick="window.location='{{ route('saas.show', $app->slug) }}'"
                        class="saas-card bg-white rounded-2xl border border-gray-200 overflow-hidden cursor-pointer hover:shadow-xl transition-all duration-300 group flex flex-col hover:-translate-y-1 h-full"
                        data-name="{{ strtolower($app->name) }}" 
                        data-category="{{ $app->category }}">

                        {{-- Image Thumbnail --}}
                        <div class="h-36 md:h-52 w-full bg-gray-100 relative overflow-hidden">
                            @php
                                $imgSrc = $app->thumbnail;
                                if (Str::startsWith($imgSrc, 'http')) {
                                    // do nothing
                                } elseif (Str::startsWith($imgSrc, 'assets/')) {
                                    $imgSrc = asset($imgSrc);
                                } elseif (Str::startsWith($imgSrc, 'storage/')) {
                                    $imgSrc = asset($imgSrc);
                                } else {
                                    $imgSrc = asset('storage/' . $imgSrc);
                                }
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $app->name }}" class="card-img w-full h-full object-cover transition-transform duration-500 ease-out">
                            
                            {{-- Badge Category --}}
                            <span class="absolute top-3 right-3 bg-white/95 backdrop-blur text-gray-800 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-gray-100">
                                {{ $app->category }}
                            </span>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-5 flex flex-col flex-1">
                            {{-- Header --}}
                            <div class="mb-3">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-1.5 text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                        <i class="ri-store-2-line text-blue-500"></i>
                                        <span class="truncate max-w-[80px] md:max-w-[120px]" title="{{ $app->partner_name }}">
                                            {{ $app->partner_name }}
                                        </span>
                                        @if($app->partner_verified ?? false)
                                            <i class="ri-verified-badge-fill text-blue-500" title="Verified Partner"></i>
                                        @endif
                                    </div>
                                    
                                    {{-- Rating Small --}}
                                    <div class="flex items-center gap-1 text-xs font-semibold text-gray-700">
                                        <i class="ri-star-fill text-yellow-400"></i>
                                        <span>{{ $app->rating }}</span>
                                    </div>
                                </div>

                                <h3 class="font-bold text-base md:text-xl text-gray-900 group-hover:text-blue-600 transition leading-snug mb-2 line-clamp-1">
                                    {{ $app->name }}
                                </h3>

                                <p class="text-gray-500 text-xs md:text-sm leading-relaxed line-clamp-2 h-10">
                                    {{ $app->description }}
                                </p>
                            </div>

                            {{-- Footer --}}
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wide">Mulai dari</p>
                                    <p class="text-blue-600 font-bold text-sm md:text-lg">
                                        Rp {{ number_format($app->price, 0, ',', '.') }}<span class="text-xs font-normal text-gray-400">{{ $app->cycle == 'monthly' ? '/bln' : ($app->cycle == 'annually' ? '/thn' : '') }}</span>
                                    </p>
                                </div>
                                <span class="bg-gray-50 hover:bg-blue-600 hover:text-white text-blue-600 border border-blue-100 text-xs md:text-sm font-bold px-4 py-2 rounded-lg transition-colors duration-300">
                                    Detail
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center md:hidden">
                <button class="w-full py-3.5 border border-gray-300 bg-white text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm">
                    Lihat Semua Aplikasi
                </button>
            </div>

            {{-- PLUGIN SECTION --}}
            @if(isset($plugins) && $plugins->count() > 0)
            <div class="mt-20">
                <div class="flex flex-col sm:flex-row justify-between items-end mb-10 gap-4 px-2">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Plugin</h2>
                        <p class="text-gray-500 mt-2">Tingkatkan performa bisnis Anda dengan plugin unggulan kami.</p>
                    </div>
                </div>

                <div id="plugin-grid" class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                    @foreach ($plugins as $plugin)
                        <div onclick="window.location='{{ route('saas.show', $plugin->slug) }}'"
                            class="saas-card bg-white rounded-2xl border border-gray-200 overflow-hidden cursor-pointer hover:shadow-xl transition-all duration-300 group flex flex-col hover:-translate-y-1 h-full"
                            data-name="{{ strtolower($plugin->name) }}" 
                            data-category="{{ $plugin->category }}">

                            {{-- Image Thumbnail --}}
                            <div class="h-36 md:h-52 w-full bg-gray-100 relative overflow-hidden">
                                @php
                                    $pImgSrc = $plugin->thumbnail;
                                    if (Str::startsWith($pImgSrc, 'http')) {
                                        // do nothing
                                    } elseif (Str::startsWith($pImgSrc, 'assets/')) {
                                        $pImgSrc = asset($pImgSrc);
                                    } elseif (Str::startsWith($pImgSrc, 'storage/')) {
                                        $pImgSrc = asset($pImgSrc);
                                    } else {
                                        $pImgSrc = asset('storage/' . $pImgSrc);
                                    }
                                @endphp
                                <img src="{{ $pImgSrc }}" alt="{{ $plugin->name }}" class="card-img w-full h-full object-cover transition-transform duration-500 ease-out">
                                
                                {{-- Badge Category --}}
                                <span class="absolute top-3 right-3 bg-white/95 backdrop-blur text-gray-800 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-gray-100">
                                    {{ $plugin->category }}
                                </span>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5 flex flex-col flex-1">
                                {{-- Header --}}
                                <div class="mb-3">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center gap-1.5 text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                            <i class="ri-store-2-line text-blue-500"></i>
                                            <span class="truncate max-w-[80px] md:max-w-[120px]" title="{{ $plugin->partner_name }}">
                                                {{ $plugin->partner_name }}
                                            </span>
                                            @if($plugin->partner_verified ?? false)
                                                <i class="ri-verified-badge-fill text-blue-500" title="Verified Partner"></i>
                                            @endif
                                        </div>
                                        
                                        {{-- Rating Small --}}
                                        <div class="flex items-center gap-1 text-xs font-semibold text-gray-700">
                                            <i class="ri-star-fill text-yellow-400"></i>
                                            <span>{{ $plugin->rating }}</span>
                                        </div>
                                    </div>

                                    <h3 class="font-bold text-base md:text-xl text-gray-900 group-hover:text-blue-600 transition leading-snug mb-2 line-clamp-1">
                                        {{ $plugin->name }}
                                    </h3>

                                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed line-clamp-2 h-10">
                                        {{ $plugin->description }}
                                    </p>
                                </div>

                                {{-- Footer --}}
                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wide">Mulai dari</p>
                                        <p class="text-blue-600 font-bold text-sm md:text-lg">
                                            Rp {{ number_format($plugin->price, 0, ',', '.') }}<span class="text-xs font-normal text-gray-400">{{ $plugin->cycle == 'monthly' ? '/bln' : ($plugin->cycle == 'annually' ? '/thn' : '') }}</span>
                                        </p>
                                    </div>
                                    <span class="bg-gray-50 hover:bg-blue-600 hover:text-white text-blue-600 border border-blue-100 text-xs md:text-sm font-bold px-4 py-2 rounded-lg transition-colors duration-300">
                                        Detail
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- 3. BOTTOM CTA (Consistent Blue Box) --}}
    <section class="w-full py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto bg-blue-600 rounded-3xl p-10 md:p-16 text-white shadow-2xl relative overflow-hidden">
            {{-- Decoration --}}
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-cyan-500 rounded-full opacity-30 blur-3xl pointer-events-none"></div>
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-purple-500 rounded-full opacity-30 blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Tidak menemukan aplikasi yang dicari?</h2>
                <p class="text-blue-100 mb-8 text-lg max-w-2xl mx-auto">
                    Request aplikasi SaaS yang Anda butuhkan atau daftarkan produk Anda sendiri ke marketplace kami.
                </p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="https://wa.me/6281289537549?text=Halo%20Tim%20FutureCloud%2C%20saya%20ingin%20Request%20Aplikasi%20Saas%20untuk%20FutureCloud%20Terima%20kasih."
                        target="_blank"
                        class="px-8 py-3 bg-white text-blue-700 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                        <i class="ri-whatsapp-line text-lg"></i> Request Aplikasi
                    </a>
                    
                    @auth
                        @if(Auth::user()->role === 'partner')
                            <a href="{{ route('partner.saas.create') }}" class="px-8 py-3 bg-blue-700/50 border-2 border-blue-400 text-white rounded-lg font-bold hover:bg-blue-700 transition">
                                Upload Produk
                            </a>
                        @else
                            <button onclick="document.getElementById('partnerModal').classList.remove('hidden')" class="px-8 py-3 bg-blue-700/50 border-2 border-blue-400 text-white rounded-lg font-bold hover:bg-blue-700 transition">
                                Jadi Partner
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-blue-700/50 border-2 border-blue-400 text-white rounded-lg font-bold hover:bg-blue-700 transition">
                            Jadi Partner
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL AJAKAN JADI PARTNER (Updated Design) --}}
    <div id="partnerModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" onclick="document.getElementById('partnerModal').classList.add('hidden')"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-md p-8 border border-gray-100">
                
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 mb-6">
                    <i class="ri-shake-hands-line text-3xl text-blue-600"></i>
                </div>
                
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Gabung Partner Program</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        Untuk mendaftarkan aplikasi SaaS, Anda harus bergabung menjadi <strong>Partner Resmi</strong> FutureCloud terlebih dahulu. Verifikasi bisnis Anda dan mulai hasilkan pendapatan.
                    </p>

                    <div class="space-y-3">
                        <a href="{{ route('partner.register') }}" class="block w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200">
                            Daftar Jadi Partner Sekarang
                        </a>
                        <button onclick="document.getElementById('partnerModal').classList.add('hidden')" class="block w-full py-3 bg-white border border-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition">
                            Nanti Saja
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('saas-search-input');
        const filterButtons = document.querySelectorAll('.category-btn');
        const cards = document.querySelectorAll('.saas-card');
        const noResultsMsg = document.getElementById('no-results-message');
        const resetBtn = document.getElementById('reset-filter-btn');

        let currentCategory = 'All';
        let currentSearch = '';

        function filterApps() {
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const category = card.getAttribute('data-category');
                
                const matchSearch = name.includes(currentSearch);
                const matchCategory = (currentCategory === 'All') || (category === currentCategory);

                if (matchSearch && matchCategory) {
                    card.classList.remove('hidden-card');
                    visibleCount++;
                } else {
                    card.classList.add('hidden-card');
                }
            });

            if (visibleCount === 0) {
                noResultsMsg.classList.remove('hidden');
            } else {
                noResultsMsg.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            filterApps();
        });

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset active styles
                filterButtons.forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'border-transparent');
                    b.classList.add('text-blue-200', 'bg-blue-900/30');
                });
                
                // Set active style
                btn.classList.remove('text-blue-200', 'bg-blue-900/30');
                btn.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'border-transparent');

                currentCategory = btn.getAttribute('data-category');
                filterApps();
            });
        });

        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            currentSearch = '';
            // Trigger click on 'All' button programmatically
            document.querySelector('.category-btn[data-category="All"]').click();
        });
    });
</script>
@endsection