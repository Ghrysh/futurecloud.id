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
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">PT Berkah Teknologi Terdepan</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Mempercepat <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Transformasi Digital</span> Indonesia
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Kami adalah mitra teknologi terpercaya yang hadir untuk mewujudkan masyarakat yang lebih berbudi luhur, inovatif, dan sejahtera melalui ekosistem teknologi digital.
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
                                <i class="ri-lightbulb-flash-line text-4xl mb-4 block text-blue-200"></i>
                                <h4 class="font-bold text-xl mb-1">Inovasi Terpadu</h4>
                                <p class="text-sm text-blue-100">Menghadirkan teknologi yang berfokus menciptakan nilai nyata (Value).</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Our Purpose</h3>
                                <p class="text-sm text-gray-500 italic leading-relaxed">"Mewujudkan masyarakat yang lebih berbudi luhur, inovatif dan sejahtera melalui teknologi."</p>
                            </div>
                        </div>
                        <div class="space-y-4 translate-y-8">
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-3xl font-bold text-gray-900 mb-1">2023</h3>
                                <p class="text-sm text-gray-500">Founded In Jakarta</p>
                            </div>
                            <div class="bg-gray-900 text-white p-6 rounded-2xl shadow-lg">
                                <i class="ri-leaf-line text-4xl mb-4 block text-gray-400"></i>
                                <h4 class="font-bold text-xl mb-1">ESG Framework</h4>
                                <p class="text-sm text-gray-400">Berkontribusi positif pada lingkungan hidup dan masyarakat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Siapa <span class="text-blue-600">FutureCloud?</span></h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    <strong>PT Berkah Teknologi Terdepan (FutureCloud.id)</strong> adalah perusahaan teknologi yang berfokus pada pengembangan solusi digital, konsultasi teknologi, SaaS, enterprise system, serta transformasi proses bisnis. Didirikan pada tahun 2023 di Jakarta, Indonesia.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Kami percaya bahwa teknologi bukan sekadar alat untuk mengotomatisasi pekerjaan, tetapi mampu menciptakan value, membuka peluang baru, meningkatkan produktivitas, serta memberikan dampak yang positif dan nyata bagi pelestarian lingkungan serta masyarakat kita.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. VISI & MISI (NEW DEDICATED LAYOUT) --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-900 text-white relative overflow-hidden">
        {{-- Dekorasi Latar Belakang --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[150px] opacity-20 -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-600 rounded-full blur-[150px] opacity-20 translate-y-1/2 -translate-x-1/3"></div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 relative z-10">
            
            {{-- Visi Section (1 Column) --}}
            <div class="col-span-1 bg-gray-800/50 backdrop-blur-md border border-gray-700 p-8 md:p-10 rounded-[32px]">
                <div class="w-16 h-16 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center text-3xl mb-8">
                    <i class="ri-eye-2-line"></i>
                </div>
                <h3 class="text-3xl font-bold mb-6">Visi Kami</h3>
                <p class="text-gray-300 leading-relaxed text-lg font-light">
                    Menjadi digital partner pilihan utama untuk memajukan ekonomi dan pendidikan serta meningkatkan kualitas lingkungan hidup.
                </p>
            </div>

            {{-- Misi Section (2 Columns) --}}
            <div class="col-span-1 lg:col-span-2 bg-gradient-to-br from-blue-700 to-blue-900 p-8 md:p-10 rounded-[32px] shadow-2xl border border-blue-600/30">
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur text-white rounded-2xl flex items-center justify-center text-3xl shadow-inner">
                        <i class="ri-rocket-2-line"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white">Misi Kami</h3>
                </div>
                
                <ul class="space-y-5">
                    <li class="flex items-start gap-4 bg-white/5 hover:bg-white/10 transition duration-300 p-5 rounded-2xl border border-white/10">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-lg">a</div>
                        <p class="text-blue-50 leading-relaxed text-base md:text-lg font-light">
                            Mengembangkan platform digital bagi para talenta digital agar bisa memberikan kontribusi positif terhadap pengembangan konsep Value as a Service (VaaS).
                        </p>
                    </li>
                    <li class="flex items-start gap-4 bg-white/5 hover:bg-white/10 transition duration-300 p-5 rounded-2xl border border-white/10">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-lg">b</div>
                        <p class="text-blue-50 leading-relaxed text-base md:text-lg font-light">
                            Melakukan orkestrasi ekosistem digital agar mempermudah pengguna dalam menentukan value of money dari produk digital yang ada.
                        </p>
                    </li>
                    <li class="flex items-start gap-4 bg-white/5 hover:bg-white/10 transition duration-300 p-5 rounded-2xl border border-white/10">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-lg">c</div>
                        <p class="text-blue-50 leading-relaxed text-base md:text-lg font-light">
                            Menjadi perusahaan yang mendukung penuh framework ESG (Environment, Social and Governance) agar memberikan kontribusi positif pada lingkungan dan masyarakat.
                        </p>
                    </li>
                </ul>
            </div>
            
        </div>
    </section>

    {{-- 4. CORE VALUES --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-50 border-y border-gray-100">
        <div class="max-w-6xl mx-auto text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wider mb-4 uppercase">Digital Value Chain</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Nilai & Pendekatan Kami</h2>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $values = [
                    ['icon' => 'ri-compasses-line', 'title' => 'Strategy & Design', 'detail' => 'Memahami secara mendalam proses bisnis Anda untuk menciptakan pengalaman pengguna (UI/UX) yang bermakna.'],
                    ['icon' => 'ri-shield-check-line', 'title' => 'Reliable Technology', 'detail' => 'Membangun produk digital berskala tinggi dengan tingkat keamanan enterprise yang dapat diandalkan.'],
                    ['icon' => 'ri-heart-pulse-line', 'title' => 'System Integration', 'detail' => 'Menghubungkan orang, data, dan berbagai platform operasional menjadi satu ekosistem yang kohesif.'],
                    ['icon' => 'ri-medal-line', 'title' => 'Measurable Value', 'detail' => 'Mengoptimalkan performa secara berkelanjutan untuk menghasilkan dampak bisnis positif (Value) yang terukur.'],
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

    {{-- 5. TIMELINE --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Perjalanan Kami</h2>
            <p class="text-gray-600 text-lg mt-4 max-w-2xl mx-auto">Tumbuh secara berkesinambungan sebagai rekan kolaboratif terpercaya inovasi digital.</p>
        </div>

        @php
            $milestones = [
                ['year' => 2023, 'title' => 'Pendirian Perusahaan', 'detail' => 'PT Berkah Teknologi Terdepan (FutureCloud.id) didirikan di Jakarta, Indonesia, membawa semangat untuk mencerdaskan ekonomi digital.'],
                ['year' => '2023 Q4', 'title' => 'Fokus Ekosistem Digital', 'detail' => 'Memantapkan landasan bisnis ke dalam empat pilar solusi: Custom Software, SaaS, Consulting, dan Enterprise System (ERP).'],
                ['year' => 2024, 'title' => 'Inovasi SaaS Dirilis', 'detail' => 'Meluncurkan layanan Smartrack.id untuk pengelolaan bisnis yang praktis, serta Scanyuk.com sebagai platform alat kreatif bagi banyak kalangan.'],
                ['year' => '2024 Q3', 'title' => 'Ekspansi Konsultasi Manajemen', 'detail' => 'Mulai mendampingi korporasi dalam implementasi proses Project Management, pemodelan OKR, dan digitalisasi kecerdasan buatan (AI).'],
                ['year' => 'Future', 'title' => 'Dampak ESG', 'detail' => 'Berkomitmen berkelanjutan untuk mengembangkan solusi yang mengimplementasikan aspek Environment, Social, & Governance demi kemajuan Indonesia.'],
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
                            <span class="font-bold text-[10px] uppercase text-blue-600">{{ $milestone['year'] }}</span>
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

    {{-- 6. OFFICE & CONTACT --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-50 border-t border-gray-100">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                
                {{-- Left: Info --}}
                <div class="w-full md:w-1/2 p-10 md:p-14 bg-gray-900 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/20 rounded-full blur-[80px]"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl font-bold mb-2">Kantor Pusat Kami</h2>
                        <p class="text-gray-400 mb-10">Kunjungi kami untuk berdiskusi sambil menikmati secangkir kopi hangat terkait kolaborasi IT Anda.</p>
                        
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