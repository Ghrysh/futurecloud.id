@extends('layouts.landing')

@section('title', 'Portfolio')

@section('styles')
    <style>
        /* Portfolio Card Hover Effect */
        .portfolio-card .overlay {
            opacity: 0;
            transition: all 0.4s ease;
        }
        .portfolio-item:hover .portfolio-card .overlay {
            opacity: 1;
        }
        .portfolio-item:hover .portfolio-card img {
            transform: scale(1.1);
        }
        
        /* Filter Button Active State */
        .filter-btn.active {
            background-color: #2563EB;
            color: white;
            border-color: #2563EB;
            box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.39);
        }
    </style>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/portfolio-hero.webp') }}" alt="Portfolio Background" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-10 right-1/4 w-48 h-48 bg-blue-500 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 left-1/4 w-64 h-64 bg-cyan-400 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Our Masterpiece</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Karya & Hasil <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Nyata</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Lihat bagaimana FutureCloud membantu bisnis bertransformasi digital melalui infrastruktur handal dan solusi perangkat lunak canggih.
            </p>
        </div>
    </section>

    {{-- PORTFOLIO SECTION --}}
    <section class="w-full py-24 bg-slate-50 min-h-screen relative overflow-hidden font-['Inter']">
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-blue-100 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            
            {{-- Filter Categories --}}
            <div class="flex flex-wrap justify-center gap-3 mb-16 scroll-reveal">
                <button class="filter-btn active px-6 py-2.5 rounded-full border border-slate-200 bg-white text-slate-600 font-bold text-sm transition-all duration-300 hover:border-blue-300 hover:text-blue-600 shadow-sm" onclick="filterPortfolio('all', this)">
                    Semua
                </button>
                @foreach($categories as $cat)
                <button class="filter-btn px-6 py-2.5 rounded-full border border-slate-200 bg-white text-slate-600 font-bold text-sm transition-all duration-300 hover:border-blue-300 hover:text-blue-600 shadow-sm" onclick="filterPortfolio('{{ Str::slug($cat) }}', this)">
                    {{ $cat }}
                </button>
                @endforeach
            </div>

            {{-- Grid Gallery --}}
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8" id="portfolio-grid">
                @foreach($portfolios as $index => $item)
                <div class="portfolio-item scroll-reveal relative h-auto md:h-[450px] w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-lg shadow-blue-900/5 hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-500 bg-white border border-slate-100 flex flex-col group hover:-translate-y-2" data-category="{{ Str::slug($item->category) }}" style="transition-delay: {{ $index * 100 }}ms;">
                    
                    {{-- Image Container (Atas) --}}
                    <div class="portfolio-card h-32 md:h-56 w-full relative overflow-hidden shrink-0">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out">
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                                <i class="ri-image-line text-4xl text-slate-400"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay on Image --}}
                        <div class="overlay absolute inset-0 bg-blue-900/70 backdrop-blur-sm flex items-center justify-center p-2">
                            <a href="{{ $item->url ?? '#' }}" target="_blank" class="px-3 py-2 md:px-6 md:py-3 bg-white text-blue-600 font-bold rounded-full transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 ease-out shadow-lg hover:bg-blue-600 hover:text-white flex items-center gap-1 md:gap-2 text-[10px] md:text-base text-center">
                                <i class="ri-external-link-line"></i> <span class="hidden md:inline">Kunjungi Project</span><span class="md:hidden">Kunjungi</span>
                            </a>
                        </div>
                        
                        {{-- Category Badge --}}
                        <div class="absolute top-2 left-2 md:top-4 md:left-4">
                            <span class="bg-white/90 backdrop-blur-md text-blue-700 text-[9px] md:text-xs font-black px-2 py-1 md:px-3 md:py-1.5 rounded-md md:rounded-lg shadow-sm border border-white/20 uppercase tracking-wide">
                                {{ $item->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Content Container (Bawah) --}}
                    <div class="p-4 md:p-8 flex-1 flex flex-col relative z-10 bg-white">
                        <h3 class="text-sm md:text-2xl font-bold text-slate-900 mb-2 md:mb-4 group-hover:text-blue-600 transition-colors leading-tight">{{ $item->title }}</h3>
                        <p class="text-slate-500 text-xs md:text-sm leading-relaxed line-clamp-2 md:line-clamp-3">
                            {{ $item->description }}
                        </p>
                        
                        {{-- Bottom Meta --}}
                        <div class="mt-auto pt-3 md:pt-6 flex items-center justify-between border-t border-slate-100">
                            <span class="text-[9px] md:text-xs text-slate-400 font-bold uppercase tracking-wider">Completed</span>
                            <div class="flex gap-1 md:gap-1.5">
                                <span class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 rounded-full bg-red-400 shadow-sm shadow-red-400/50"></span>
                                <span class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 rounded-full bg-amber-400 shadow-sm shadow-amber-400/50"></span>
                                <span class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 rounded-full bg-emerald-400 shadow-sm shadow-emerald-400/50"></span>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- Empty State (Hidden by default) --}}
            <div id="empty-state" class="hidden text-center py-24 scroll-reveal">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-50 text-blue-300 mb-6 border-8 border-white shadow-lg">
                    <i class="ri-folder-open-line text-4xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-700 mb-2">Belum ada project</h3>
                <p class="text-slate-500">Kami belum menambahkan portofolio di kategori ini.</p>
            </div>

        </div>
    </section>

    {{-- CTA FOOTER --}}
    <section class="w-full py-24 px-4 text-center bg-white relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-[300px] bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 opacity-50 blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <div class="bg-white border border-blue-100 rounded-[2.5rem] p-10 md:p-16 shadow-2xl shadow-blue-900/5 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/5 rounded-bl-full pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-cyan-400/5 rounded-tr-full pointer-events-none"></div>
                
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6 text-slate-900 tracking-tight">Ingin Project Anda Selanjutnya Ada Disini?</h2>
                <p class="text-slate-500 mb-10 text-lg font-medium max-w-xl mx-auto">Percayakan infrastruktur dan pengembangan digital Anda kepada tim ahli di FutureCloud.</p>
                <a href="{{ url('/contact') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition-all hover:-translate-y-1 shadow-lg shadow-blue-600/30">
                    Mulai Konsultasi Gratis <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    function filterPortfolio(category, btn) {
        // Update Button Styles
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600', 'shadow-blue-600/30');
            b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
        });
        
        btn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
        btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600', 'shadow-blue-600/30');

        // Filter Items
        const items = document.querySelectorAll('.portfolio-item');
        let visibleCount = 0;

        items.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'flex'; // Kembalikan ke flex karena layout card menggunakan flex-col
                // Tambahkan sedikit animasi fade in
                item.style.opacity = '0';
                item.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease-out';
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 50);
                visibleCount++;
            } else {
                item.style.display = 'none';
                item.style.opacity = '0';
                item.style.transform = 'scale(0.95)';
            }
        });

        // Show/Hide Empty State
        const emptyState = document.getElementById('empty-state');
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
            setTimeout(() => {
                emptyState.style.opacity = '1';
                emptyState.style.transform = 'translateY(0)';
            }, 50);
        } else {
            emptyState.classList.add('hidden');
            emptyState.style.opacity = '0';
            emptyState.style.transform = 'translateY(20px)';
        }
    }
</script>
@endsection
