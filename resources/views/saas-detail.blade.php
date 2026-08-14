@extends('layouts.landing')

@section('title', 'SaaS Marketplace - FutureCloud.id')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        
        .hidden-card { display: none !important; }
        
        /* Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        /* App Card Hover */
        .app-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .app-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(37, 99, 235, 0.15);
            border-color: #BFDBFE;
        }
        .app-card:hover .app-img {
            transform: scale(1.05);
        }
        
        /* Category Item Hover */
        .cat-item.active {
            background-color: #EFF6FF;
            color: #2563EB;
            font-weight: 700;
            border-right: 3px solid #2563EB;
        }
        
        /* Horizontal Scroll for Mobile Categories */
        .mobile-cat-scroll {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }
        .mobile-cat-scroll::-webkit-scrollbar { display: none; }
        .mobile-cat-btn.active {
            background-color: #2563EB;
            color: white;
            border-color: #2563EB;
        }
    </style>
@endsection

@section('content')

    {{-- HERO SECTION (Marketplace Style) --}}
    <section class="w-full pt-32 pb-16 px-4 bg-gradient-to-b from-[#0f172a] to-[#1e293b] text-white relative overflow-hidden">
        {{-- Background Elements --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/20 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.webp')] opacity-10 mix-blend-overlay"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-bold uppercase tracking-wider mb-6">
                <i class="ri-store-2-fill"></i> FutureCloud Marketplace
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight max-w-4xl">
                Temukan Solusi Digital <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Untuk Memajukan Bisnis Anda</span>
            </h1>

            <p class="text-slate-300 text-lg md:text-xl mb-10 max-w-2xl font-light">
                Jelajahi ratusan aplikasi SaaS dan Plugin berkualitas yang siap diintegrasikan untuk meningkatkan produktivitas perusahaan Anda.
            </p>

            {{-- Main Search Bar --}}
            <div class="w-full max-w-3xl bg-white/10 backdrop-blur-md p-2 rounded-2xl border border-white/10 shadow-2xl flex flex-col sm:flex-row gap-2">
                <div class="flex-1 flex items-center bg-white rounded-xl px-4 py-3">
                    <i class="ri-search-2-line text-blue-600 text-xl mr-3"></i>
                    <input type="text" id="saas-search-input" placeholder="Cari aplikasi, plugin, atau kategori..." class="w-full bg-transparent border-none outline-none text-slate-800 placeholder:text-slate-400 font-medium text-base">
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg flex items-center justify-center gap-2">
                    Cari <i class="ri-arrow-right-line hidden sm:inline-block"></i>
                </button>
            </div>
            
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-sm text-slate-300">
                <span>Populer:</span>
                <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full cursor-pointer hover:bg-white/10 transition">CRM</span>
                <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full cursor-pointer hover:bg-white/10 transition">Akuntansi</span>
                <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full cursor-pointer hover:bg-white/10 transition">HRIS</span>
            </div>
        </div>
    </section>

    {{-- MARKETPLACE MAIN LAYOUT --}}
    <section class="w-full py-12 px-4 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
            
            {{-- SIDEBAR FILTERS (DESKTOP) --}}
            <aside class="hidden lg:block w-64 shrink-0">
                <div class="sticky top-28 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Kategori</h3>
                    
                    <ul class="space-y-1" id="desktop-category-list">
                        @php $categories = ['All', 'Security', 'Productivity', 'Marketing', 'Sales', 'HR', 'Finance', 'Plugin']; @endphp
                        @foreach ($categories as $index => $cat)
                            <li>
                                <button class="cat-item w-full text-left px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors {{ $index === 0 ? 'active' : '' }}" data-category="{{ $cat }}">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $cat === 'All' ? 'Semua Kategori' : $cat }}</span>
                                        @if($index === 0)
                                            <i class="ri-arrow-right-s-line text-blue-600"></i>
                                        @endif
                                    </div>
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 text-center">
                            <i class="ri-store-2-line text-3xl text-blue-600 mb-2"></i>
                            <h4 class="font-bold text-blue-900 text-sm mb-1">Punya Aplikasi?</h4>
                            <p class="text-xs text-blue-700 mb-3">Jangkau ribuan klien kami dengan menjadi partner.</p>
                            <a href="{{ route('partner.register') }}" class="block w-full py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition">Daftar Partner</a>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- MOBILE FILTERS (HORIZONTAL SCROLL) --}}
            <div class="lg:hidden w-full mb-6">
                <div class="mobile-cat-scroll gap-2 pb-2">
                    @foreach ($categories as $index => $cat)
                        <button class="mobile-cat-btn shrink-0 px-4 py-2 rounded-full border border-slate-200 bg-white text-slate-600 text-sm font-medium shadow-sm {{ $index === 0 ? 'active' : '' }}" data-category="{{ $cat }}">
                            {{ $cat === 'All' ? 'Semua' : $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- MAIN CONTENT GRID --}}
            <main class="flex-1">
                
                {{-- Header Section Title --}}
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-900" id="section-title">Semua Aplikasi</h2>
                    
                    <div class="flex items-center gap-2 text-sm text-slate-500 bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <i class="ri-sort-desc"></i>
                        <select class="bg-transparent border-none outline-none font-medium text-slate-700 focus:ring-0 cursor-pointer">
                            <option>Terpopuler</option>
                            <option>Terbaru</option>
                            <option>Rating Tertinggi</option>
                            <option>Harga Termurah</option>
                        </select>
                    </div>
                </div>

                {{-- Pesan Tidak Ada Hasil --}}
                <div id="no-results-message" class="hidden text-center py-20 bg-white rounded-2xl border border-dashed border-slate-300">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-search-eye-line text-3xl text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Tidak ada aplikasi yang cocok</h3>
                    <p class="text-slate-500 mt-1 text-sm">Coba sesuaikan filter atau gunakan kata kunci lain.</p>
                </div>

                {{-- SAAS GRID --}}
                <div id="saas-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($apps as $app)
                        <div onclick="window.location='{{ route('saas.show', $app->slug) }}'"
                            class="app-card bg-white rounded-2xl border border-slate-200 overflow-hidden cursor-pointer flex flex-col h-full relative"
                            data-name="{{ strtolower($app->name) }}" 
                            data-category="{{ $app->category }}">
                            
                            {{-- Top Cover Image (Marketplace Style) --}}
                            <div class="h-24 md:h-32 w-full bg-slate-100 relative overflow-hidden border-b border-slate-100">
                                <img src="{{ $app->thumbnail_url }}" alt="{{ $app->name }}" class="app-img w-full h-full object-cover transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                
                                {{-- Category Badge --}}
                                <div class="absolute top-2 right-2 md:top-3 md:right-3">
                                    <span class="bg-white/90 backdrop-blur text-slate-700 text-[8px] md:text-[10px] font-bold px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md shadow-sm border border-white/20 uppercase tracking-wide">
                                        {{ $app->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- App Info Body --}}
                            <div class="p-3 md:p-5 flex flex-col flex-1 relative">
                                
                                {{-- App Icon / Logo Placeholder --}}
                                <div class="absolute -top-6 left-3 md:-top-10 md:left-5 w-12 h-12 md:w-16 md:h-16 bg-white rounded-lg md:rounded-xl shadow-md border border-slate-100 p-1 flex items-center justify-center overflow-hidden z-10">
                                    <div class="w-full h-full bg-blue-50 rounded-md md:rounded-lg flex items-center justify-center text-blue-600 font-black text-lg md:text-xl">
                                        {{ substr($app->name, 0, 1) }}
                                    </div>
                                </div>

                                {{-- Partner Name & Rating --}}
                                <div class="mt-6 md:mt-8 flex justify-between items-center mb-1.5 md:mb-2">
                                    <div class="flex items-center gap-1 text-[10px] md:text-xs font-medium text-slate-500">
                                        <i class="ri-store-2-line text-slate-400"></i>
                                        <span class="truncate max-w-[80px] md:max-w-[120px]">{{ $app->partner_name }}</span>
                                        @if($app->partner_verified ?? false)
                                            <i class="ri-verified-badge-fill text-blue-500" title="Verified Partner"></i>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-0.5 md:gap-1 text-[10px] md:text-xs font-bold text-slate-700">
                                        <i class="ri-star-fill text-yellow-400"></i>
                                        {{ $app->rating }}
                                    </div>
                                </div>

                                {{-- Title & Desc --}}
                                <h3 class="font-bold text-sm md:text-lg text-slate-900 leading-tight mb-1 md:mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                    {{ $app->name }}
                                </h3>
                                <p class="text-slate-500 text-[10px] md:text-sm line-clamp-2 mb-3 md:mb-4 h-8 md:h-10">
                                    {{ $app->description }}
                                </p>

                                {{-- Footer / Pricing --}}
                                <div class="mt-auto pt-3 md:pt-4 border-t border-slate-100 flex items-end justify-between">
                                    <div>
                                        <span class="block text-[8px] md:text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">Harga</span>
                                        <div class="flex items-baseline gap-0.5 md:gap-1">
                                            <span class="text-blue-700 font-extrabold text-sm md:text-lg">Rp{{ number_format($app->price / 1000, 0, ',', '.') }}k</span>
                                            <span class="text-[10px] md:text-xs text-slate-400">{{ in_array($app->cycle, ['monthly', 'monthly_yearly']) ? '/bln' : ($app->cycle == 'annually' ? '/thn' : '') }}</span>
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all shadow-sm">
                                        <i class="ri-arrow-right-up-line text-sm md:text-base"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    {{-- PLUGINS in same grid if we want to combine them, or keep separate --}}
                    @if(isset($plugins) && $plugins->count() > 0)
                        @foreach ($plugins as $plugin)
                            <div onclick="window.location='{{ route('saas.show', $plugin->slug) }}'"
                                class="app-card bg-white rounded-2xl border border-slate-200 overflow-hidden cursor-pointer flex flex-col h-full relative"
                                data-name="{{ strtolower($plugin->name) }}" 
                                data-category="{{ $plugin->category }}">
                                
                                <div class="h-24 md:h-32 w-full bg-slate-100 relative overflow-hidden border-b border-slate-100">
                                    <img src="{{ $plugin->thumbnail_url }}" alt="{{ $plugin->name }}" class="app-img w-full h-full object-cover transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    
                                    <div class="absolute top-2 right-2 md:top-3 md:right-3">
                                        <span class="bg-blue-600/90 backdrop-blur text-white text-[8px] md:text-[10px] font-bold px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md shadow-sm border border-blue-500/20 uppercase tracking-wide">
                                            PLUGIN
                                        </span>
                                    </div>
                                </div>

                                <div class="p-3 md:p-5 flex flex-col flex-1 relative">
                                    
                                    <div class="absolute -top-6 left-3 md:-top-10 md:left-5 w-12 h-12 md:w-16 md:h-16 bg-white rounded-lg md:rounded-xl shadow-md border border-slate-100 p-1 flex items-center justify-center overflow-hidden z-10">
                                        <div class="w-full h-full bg-purple-50 rounded-md md:rounded-lg flex items-center justify-center text-purple-600 font-black text-lg md:text-xl">
                                            <i class="ri-plug-line"></i>
                                        </div>
                                    </div>

                                    <div class="mt-6 md:mt-8 flex justify-between items-center mb-1.5 md:mb-2">
                                        <div class="flex items-center gap-1 text-[10px] md:text-xs font-medium text-slate-500">
                                            <i class="ri-store-2-line text-slate-400"></i>
                                            <span class="truncate max-w-[80px] md:max-w-[120px]">{{ $plugin->partner_name }}</span>
                                            @if($plugin->partner_verified ?? false)
                                                <i class="ri-verified-badge-fill text-blue-500"></i>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-0.5 md:gap-1 text-[10px] md:text-xs font-bold text-slate-700">
                                            <i class="ri-star-fill text-yellow-400"></i>
                                            {{ $plugin->rating }}
                                        </div>
                                    </div>

                                    <h3 class="font-bold text-sm md:text-lg text-slate-900 leading-tight mb-1 md:mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                        {{ $plugin->name }}
                                    </h3>
                                    <p class="text-slate-500 text-[10px] md:text-sm line-clamp-2 mb-3 md:mb-4 h-8 md:h-10">
                                        {{ $plugin->description }}
                                    </p>

                                    <div class="mt-auto pt-3 md:pt-4 border-t border-slate-100 flex items-end justify-between">
                                        <div>
                                            <span class="block text-[8px] md:text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">Harga</span>
                                            <div class="flex items-baseline gap-0.5 md:gap-1">
                                                <span class="text-blue-700 font-extrabold text-sm md:text-lg">Rp{{ number_format($plugin->price / 1000, 0, ',', '.') }}k</span>
                                                <span class="text-[10px] md:text-xs text-slate-400">{{ in_array($plugin->cycle, ['monthly', 'monthly_yearly']) ? '/bln' : ($plugin->cycle == 'annually' ? '/thn' : '') }}</span>
                                            </div>
                                        </div>
                                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all shadow-sm">
                                            <i class="ri-arrow-right-up-line text-sm md:text-base"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </main>
        </div>
    </section>

    {{-- BOTTOM CTA (Modern Banner) --}}
    <section class="w-full py-16 px-4 bg-white border-t border-slate-100">
        <div class="max-w-5xl mx-auto bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[2rem] p-8 md:p-12 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.webp')] opacity-10 mix-blend-overlay pointer-events-none"></div>
            
            <div class="relative z-10 flex-1 text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-3">Ingin Menjadi Kreator?</h2>
                <p class="text-blue-100 text-sm md:text-base max-w-lg">
                    Daftarkan produk SaaS atau Plugin karya Anda dan raih keuntungan dengan menjualnya di FutureCloud Marketplace.
                </p>
            </div>
            
            <div class="relative z-10 shrink-0">
                @auth
                    @if(Auth::user()->role === 'partner')
                        <a href="{{ route('partner.saas.create') }}" class="px-8 py-4 bg-white text-blue-700 rounded-xl font-bold hover:bg-slate-50 hover:shadow-lg transition flex items-center gap-2">
                            <i class="ri-upload-cloud-2-line"></i> Upload Produk
                        </a>
                    @else
                        <button onclick="document.getElementById('partnerModal').classList.remove('hidden')" class="px-8 py-4 bg-white text-blue-700 rounded-xl font-bold hover:bg-slate-50 hover:shadow-lg transition flex items-center gap-2">
                            Mulai Berjualan
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-blue-700 rounded-xl font-bold hover:bg-slate-50 hover:shadow-lg transition flex items-center gap-2">
                        Daftar Sebagai Partner
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- MODAL AJAKAN JADI PARTNER --}}
    <div id="partnerModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('partnerModal').classList.add('hidden')"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-md p-8">
                
                <div class="absolute top-4 right-4 cursor-pointer text-slate-400 hover:text-slate-600" onclick="document.getElementById('partnerModal').classList.add('hidden')">
                    <i class="ri-close-line text-2xl"></i>
                </div>

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 mb-6">
                    <i class="ri-store-2-fill text-3xl text-blue-600"></i>
                </div>
                
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Buka Toko Anda</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">
                        Untuk menjual aplikasi SaaS atau Plugin, Anda perlu mendaftar sebagai <strong>Partner Resmi</strong>. Prosesnya cepat dan mudah!
                    </p>

                    <div class="space-y-3">
                        <a href="{{ route('partner.register') }}" class="block w-full py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                            Daftar Jadi Partner
                        </a>
                        <button onclick="document.getElementById('partnerModal').classList.add('hidden')" class="block w-full py-3.5 bg-slate-50 text-slate-600 font-semibold rounded-xl hover:bg-slate-100 transition">
                            Tutup
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
        const desktopCatBtns = document.querySelectorAll('.cat-item');
        const mobileCatBtns = document.querySelectorAll('.mobile-cat-btn');
        const cards = document.querySelectorAll('.app-card');
        const noResultsMsg = document.getElementById('no-results-message');
        const sectionTitle = document.getElementById('section-title');

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
            
            // Update Title
            if(currentSearch !== '') {
                sectionTitle.textContent = `Hasil Pencarian: "${currentSearch}"`;
            } else {
                sectionTitle.textContent = currentCategory === 'All' ? 'Semua Aplikasi' : `Kategori: ${currentCategory}`;
            }
        }

        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            filterApps();
        });

        function handleCategorySelect(btn, group, otherGroup) {
            // Update Active State for current group
            group.forEach(b => {
                b.classList.remove('active');
                // For desktop specific styles
                if(b.classList.contains('cat-item')) {
                    b.classList.remove('bg-EFF6FF', 'text-blue-600', 'font-bold', 'border-blue-600');
                    b.classList.add('text-slate-600');
                    const icon = b.querySelector('.ri-arrow-right-s-line');
                    if(icon) icon.remove();
                }
                // For mobile specific styles
                if(b.classList.contains('mobile-cat-btn')) {
                    b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
                }
            });

            // Set active styles
            btn.classList.add('active');
            
            if(btn.classList.contains('cat-item')) {
                btn.classList.add('text-blue-600', 'font-bold');
                btn.classList.remove('text-slate-600');
                if(!btn.querySelector('.ri-arrow-right-s-line')) {
                    btn.querySelector('div').insertAdjacentHTML('beforeend', '<i class="ri-arrow-right-s-line text-blue-600"></i>');
                }
            } else if (btn.classList.contains('mobile-cat-btn')) {
                btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                btn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
            }

            currentCategory = btn.getAttribute('data-category');
            
            // Sync with other group silently
            otherGroup.forEach(b => {
                if(b.getAttribute('data-category') === currentCategory) {
                    b.classList.add('active');
                    if(b.classList.contains('cat-item')) {
                        b.classList.add('text-blue-600', 'font-bold');
                        b.classList.remove('text-slate-600');
                        if(!b.querySelector('.ri-arrow-right-s-line')) {
                            b.querySelector('div').insertAdjacentHTML('beforeend', '<i class="ri-arrow-right-s-line text-blue-600"></i>');
                        }
                    } else if (b.classList.contains('mobile-cat-btn')) {
                        b.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                        b.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
                    }
                } else {
                    b.classList.remove('active');
                    if(b.classList.contains('cat-item')) {
                        b.classList.remove('text-blue-600', 'font-bold');
                        b.classList.add('text-slate-600');
                        const icon = b.querySelector('.ri-arrow-right-s-line');
                        if(icon) icon.remove();
                    } else if (b.classList.contains('mobile-cat-btn')) {
                        b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                        b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
                    }
                }
            });

            filterApps();
        }

        desktopCatBtns.forEach(btn => {
            btn.addEventListener('click', () => handleCategorySelect(btn, desktopCatBtns, mobileCatBtns));
        });

        mobileCatBtns.forEach(btn => {
            btn.addEventListener('click', () => handleCategorySelect(btn, mobileCatBtns, desktopCatBtns));
        });
    });
</script>
@endsection
