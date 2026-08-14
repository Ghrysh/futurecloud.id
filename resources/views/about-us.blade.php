@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')

    {{-- 1. HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/about-us-hero.webp') }}" alt="FutureCloud Background" class="w-full h-full object-cover opacity-20 mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-1/4 left-10 w-48 h-48 bg-blue-500 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 right-1/4 w-64 h-64 bg-cyan-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Kenali Kami Lebih Dekat</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Mempercepat <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Masa Depan Digital</span> Indonesia
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Kami adalah mitra teknologi terpercaya yang berdedikasi untuk memberikan solusi infrastruktur cloud dan pengembangan perangkat lunak terbaik untuk kesuksesan bisnis Anda.
            </p>
        </div>
    </section>

    {{-- 2. WHO WE ARE --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100 rounded-[40px] blur-[60px] opacity-60"></div>
                <div class="relative bg-gray-50 border border-gray-100 p-8 rounded-[32px] shadow-2xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
                                <i class="ri-rocket-2-line text-4xl mb-4 block text-blue-200"></i>
                                <h4 class="font-bold text-xl mb-1">Misi Kami</h4>
                                <p class="text-sm text-blue-100">Memberdayakan bisnis melalui teknologi mutakhir.</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-3xl font-bold text-gray-900 mb-1">98%</h3>
                                <p class="text-sm text-gray-500">Klien Bertahan</p>
                            </div>
                        </div>
                        <div class="space-y-4 translate-y-8">
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-3xl font-bold text-gray-900 mb-1">24/7</h3>
                                <p class="text-sm text-gray-500">Dukungan Penuh</p>
                            </div>
                            <div class="bg-gray-900 text-white p-6 rounded-2xl shadow-lg">
                                <i class="ri-eye-line text-4xl mb-4 block text-gray-400"></i>
                                <h4 class="font-bold text-xl mb-1">Visi Kami</h4>
                                <p class="text-sm text-gray-400">Menjadi penyedia cloud No.1 di Asia Tenggara.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Siapa <span class="text-blue-600">FutureCloud?</span></h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    <strong>PT Berkah Teknologi Terdepan (FutureCloud.id)</strong> adalah penyedia terkemuka di Indonesia untuk infrastruktur cloud generasi mendatang, pengembangan aplikasi kustom, dan layanan konsultasi TI strategis.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Misi utama kami adalah memberdayakan bisnis dengan teknologi cloud mutakhir dan solusi inovatif yang mendorong transformasi digital, meningkatkan efisiensi operasional, serta mempercepat pertumbuhan perusahaan Anda.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. CORE VALUES --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-50 border-y border-gray-100">
        <div class="max-w-6xl mx-auto text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wider mb-4 uppercase">Budaya Perusahaan</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Nilai Inti Kami</h2>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $values = [
                    ['icon' => 'ri-compasses-line', 'title' => 'Inovasi Tanpa Henti', 'detail' => 'Kami tidak pernah berhenti bereksplorasi. Melampaui batas untuk memberikan solusi teknologi paling mutakhir.'],
                    ['icon' => 'ri-shield-check-line', 'title' => 'Keamanan Ekstra', 'detail' => 'Data Anda adalah nyawa bisnis Anda. Perlindungan tingkat perusahaan adalah prioritas utama kami.'],
                    ['icon' => 'ri-heart-pulse-line', 'title' => 'Fokus Klien', 'detail' => 'Dedikasi penuh pada kesuksesan Anda. Jika Anda bertumbuh, kami pun ikut bertumbuh.'],
                    ['icon' => 'ri-medal-line', 'title' => 'Keunggulan Mutu', 'detail' => 'Kami mempertahankan standar tertinggi dalam kualitas layanan, kode, maupun infrastruktur perangkat keras.'],
                ];
            @endphp

            @foreach ($values as $value)
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 hover:border-blue-300 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="{{ $value['icon'] }}"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $value['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $value['detail'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. TIMELINE --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Perjalanan Kami</h2>
            <p class="text-gray-600 text-lg mt-4 max-w-2xl mx-auto">Dari mimpi kecil hingga menjadi pelopor penyedia infrastruktur terkemuka.</p>
        </div>

        @php
            $milestones = [
                ['year' => 2018, 'title' => 'Langkah Pertama', 'detail' => 'Didirikan dengan visi untuk merevolusi ekosistem cloud lokal di Indonesia, bermula dari satu rak server.'],
                ['year' => 2019, 'title' => 'Kemitraan Global', 'detail' => 'Mengamankan kemitraan strategis dengan penyedia hardware global terkemuka untuk infrastruktur.'],
                ['year' => 2021, 'title' => 'Keamanan & Kepatuhan', 'detail' => 'Meraih sertifikasi standar internasional ISO 27001 untuk manajemen keamanan informasi.'],
                ['year' => 2023, 'title' => 'Ekspansi Internasional', 'detail' => 'Memperluas operasi dan zona ketersediaan data center di seluruh Asia Tenggara.'],
                ['year' => 2024, 'title' => 'Inovasi AI', 'detail' => 'Meluncurkan divisi R&D khusus yang berfokus pada solusi integrasi Kecerdasan Buatan (AI) di cloud.'],
            ];
        @endphp

        <div class="max-w-3xl mx-auto relative px-4">
            {{-- Vertical Line --}}
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-0.5 bg-blue-100 md:-translate-x-1/2"></div>

            <div class="space-y-12">
                @foreach ($milestones as $index => $milestone)
                    @php $isLeft = $index % 2 == 0; @endphp
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between group">
                        
                        {{-- Left Side (Desktop) / Hidden Mobile --}}
                        <div class="hidden md:block w-[45%] text-right pr-8 {{ $isLeft ? 'opacity-100' : 'opacity-0' }}">
                            <h3 class="font-bold text-xl text-gray-900">{{ $milestone['title'] }}</h3>
                            <p class="text-gray-600 mt-2">{{ $milestone['detail'] }}</p>
                        </div>

                        {{-- Node --}}
                        <div class="absolute left-0 md:left-1/2 md:-translate-x-1/2 w-16 h-16 rounded-full bg-white border-4 border-blue-100 flex items-center justify-center shadow-lg group-hover:border-blue-500 group-hover:bg-blue-50 transition-colors z-10">
                            <span class="font-bold text-blue-600">{{ $milestone['year'] }}</span>
                        </div>

                        {{-- Right Side (Desktop) / Main Mobile --}}
                        <div class="w-full pl-24 md:pl-0 md:w-[45%] {{ $isLeft ? 'md:opacity-0 md:text-left' : 'md:pl-8 md:text-left opacity-100' }}">
                            <div class="md:hidden">
                                <h3 class="font-bold text-lg text-gray-900">{{ $milestone['title'] }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ $milestone['detail'] }}</p>
                            </div>
                            <div class="hidden md:block">
                                <h3 class="font-bold text-xl text-gray-900">{{ $milestone['title'] }}</h3>
                                <p class="text-gray-600 mt-2">{{ $milestone['detail'] }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 5. OFFICE & CONTACT --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-50 border-t border-gray-100">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                
                {{-- Left: Info --}}
                <div class="w-full md:w-1/2 p-10 md:p-14 bg-gray-900 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/20 rounded-full blur-[80px]"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl font-bold mb-2">Kantor Pusat Kami</h2>
                        <p class="text-gray-400 mb-10">Kunjungi kami untuk berdiskusi sambil menikmati secangkir kopi hangat.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-blue-400 font-semibold mb-1 uppercase text-sm tracking-wider">Perusahaan</h4>
                                <p class="font-bold text-xl">PT Berkah Teknologi Terdepan</p>
                            </div>
                            <div>
                                <h4 class="text-blue-400 font-semibold mb-1 uppercase text-sm tracking-wider">Alamat</h4>
                                <address class="text-gray-300 not-italic leading-relaxed">
                                    Gedung Jaya Lomba 5 unit A.6<br>
                                    JL. M H Thamrin No.12<br>
                                    Jakarta Pusat 10340, Indonesia
                                </address>
                            </div>
                            <div class="pt-6 border-t border-gray-800">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-xl text-white"><i class="ri-phone-line"></i></div>
                                    <p class="text-lg">(+62) 815-2022-225</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-xl text-white"><i class="ri-mail-line"></i></div>
                                    <p class="text-lg">info@futurecloud.id</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Placeholder Maps / Decor --}}
                <div class="w-full md:w-1/2 relative bg-blue-50 min-h-[300px] flex items-center justify-center">
                    <div class="text-center p-8">
                        <i class="ri-map-pin-2-fill text-6xl text-blue-300 mb-4 inline-block"></i>
                        <h3 class="font-bold text-gray-900 text-xl mb-2">Pusat Bisnis Jakarta</h3>
                        <p class="text-gray-500">Berlokasi strategis di jantung pusat bisnis Ibukota.</p>
                        <a href="https://maps.google.com" target="_blank" class="mt-6 inline-block px-6 py-2.5 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                            Buka di Google Maps
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
