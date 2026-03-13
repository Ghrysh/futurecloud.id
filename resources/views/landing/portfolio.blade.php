@extends('layouts.landing')

@section('title', 'Portfolio & Case Studies - FutureCloud.id')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        
        /* Portfolio Card Hover Effect */
        .portfolio-card .overlay {
            opacity: 0;
            transition: all 0.4s ease;
        }
        .portfolio-card:hover .overlay {
            opacity: 1;
        }
        .portfolio-card:hover img {
            transform: scale(1.1);
        }
        
        /* Filter Button Active State */
        .filter-btn.active {
            background-color: #2563EB;
            color: white;
            border-color: #2563EB;
        }
    </style>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Abstract Shapes --}}
        <div class="absolute top-20 left-0 w-72 h-72 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute bottom-20 right-0 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <span class="text-cyan-400 font-bold tracking-widest uppercase text-sm mb-4 block">Our Masterpiece</span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                Karya & Hasil <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Nyata</span>
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed px-2 font-light">
                Lihat bagaimana FutureCloud membantu bisnis bertransformasi digital melalui infrastruktur handal dan solusi perangkat lunak canggih.
            </p>
        </div>
    </section>

    {{-- PORTFOLIO SECTION --}}
    <section class="w-full py-16 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            {{-- Filter Categories --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button class="filter-btn active px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-medium text-sm hover:bg-gray-100 transition duration-300" onclick="filterPortfolio('all', this)">
                    Semua
                </button>
                @foreach($categories as $cat)
                <button class="filter-btn px-6 py-2 rounded-full border border-gray-300 text-gray-600 font-medium text-sm hover:bg-gray-100 transition duration-300" onclick="filterPortfolio('{{ Str::slug($cat) }}', this)">
                    {{ $cat }}
                </button>
                @endforeach
            </div>

            {{-- Grid Gallery --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
                @foreach($portfolios as $item)
                <div class="portfolio-item group relative h-[450px] w-full rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 bg-white flex flex-col" data-category="{{ Str::slug($item->category) }}">
                    
                    {{-- Image Container (Atas) --}}
                    <div class="portfolio-card h-64 w-full relative overflow-hidden">
                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700">
                        
                        {{-- Overlay on Image --}}
                        <div class="overlay absolute inset-0 bg-blue-900/80 flex items-center justify-center backdrop-blur-sm">
                            <a href="{{ $item->url ?? '#' }}" target="_blank" class="px-6 py-3 bg-white text-blue-900 font-bold rounded-full transform translate-y-4 group-hover:translate-y-0 transition duration-300 hover:bg-cyan-400 hover:text-white">
                                <i class="ri-external-link-line mr-2"></i> Kunjungi Project
                            </a>
                        </div>
                        
                        {{-- Category Badge --}}
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-blue-800 text-xs font-bold px-3 py-1 rounded-md shadow-sm">
                            {{ $item->category }}
                        </span>
                    </div>

                    {{-- Content Container (Bawah) --}}
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">{{ $item->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                            {{ $item->description }}
                        </p>
                        
                        {{-- Bottom Meta --}}
                        <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-100">
                            <span class="text-xs text-gray-400 font-medium">Completed Project</span>
                            <div class="flex gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- Empty State (Hidden by default) --}}
            <div id="empty-state" class="hidden text-center py-20">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <i class="ri-folder-open-line text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700">Belum ada project di kategori ini.</h3>
            </div>

        </div>
    </section>

    {{-- CTA FOOTER --}}
    <section class="w-full py-20 px-4 text-center bg-white">
        <div class="max-w-4xl mx-auto border border-gray-100 bg-gradient-to-b from-white to-blue-50 rounded-3xl p-10 md:p-16 shadow-xl">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-900">Ingin Project Anda Selanjutnya Ada Disini?</h2>
            <p class="text-gray-600 mb-8 text-lg">Percayakan infrastruktur dan pengembangan digital Anda kepada FutureCloud.</p>
            <a href="{{ url('/contact') }}"
                class="inline-block px-8 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    function filterPortfolio(category, btn) {
        // Update Button Styles
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
            b.classList.add('border-gray-300', 'text-gray-600');
        });
        
        btn.classList.remove('border-gray-300', 'text-gray-600');
        btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');

        // Filter Items
        const items = document.querySelectorAll('.portfolio-item');
        let visibleCount = 0;

        items.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'flex'; // Kembalikan ke flex karena layout card menggunakan flex-col
                // Tambahkan sedikit animasi fade in
                item.style.opacity = '0';
                setTimeout(() => item.style.opacity = '1', 50);
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/Hide Empty State
        const emptyState = document.getElementById('empty-state');
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }
</script>
@endsection