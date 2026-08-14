@extends('layouts.landing')

@section('title', 'Layanan')

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-20 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/services-hero.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/90"></div>
        </div>

        <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none z-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-purple-500 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wider mb-4 uppercase">Transformasi Digital</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Layanan & Solusi<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Teknologi Terdepan</span>
            </h1>

            <p class="text-blue-100 text-lg mb-8 font-light max-w-2xl mx-auto leading-relaxed px-4">
                Kami menyediakan ekosistem layanan IT menyeluruh mulai dari infrastruktur awan, pengembangan perangkat lunak kustom, hingga strategi transformasi digital untuk menskalakan bisnis Anda.
            </p>
        </div>
    </section>

    {{-- SERVICES SECTIONS --}}
    
    {{-- 1. Infrastruktur Cloud --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative">
                <div class="absolute inset-0 bg-blue-100 rounded-full blur-[80px] opacity-60"></div>
                <div class="relative bg-white border border-gray-100 rounded-3xl p-8 shadow-xl shadow-blue-900/5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-2xl">
                            <i class="ri-global-line text-3xl text-blue-600 mb-4 block"></i>
                            <h4 class="font-bold text-gray-900 mb-2">Registrasi Domain</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">Amankan identitas digital Anda dengan berbagai pilihan ekstensi domain premium.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl">
                            <i class="ri-server-line text-3xl text-blue-600 mb-4 block"></i>
                            <h4 class="font-bold text-gray-900 mb-2">Cloud Hosting</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">Hosting cepat dengan cPanel, SSL gratis, dan backup otomatis harian.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl sm:col-span-2 flex items-center gap-6">
                            <div class="shrink-0 w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-2xl">
                                <i class="ri-hard-drive-2-line"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">VPS & Dedicated Server</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">Performa maksimal dengan akses root penuh, NVMe SSD, dan resource dedicated untuk aplikasi skala besar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/30">
                    <i class="ri-cloud-windy-line"></i>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Infrastruktur Cloud & <span class="text-blue-600">Hosting</span></h2>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    Fondasi digital yang kuat sangat penting untuk pertumbuhan bisnis. Layanan infrastruktur awan kami dirancang untuk memberikan keandalan tinggi (Uptime 99.9%), keamanan data tingkat enterprise, dan skalabilitas instan kapan pun bisnis Anda membutuhkannya.
                </p>
                <a href="{{ url('/catalog') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition">
                    Jelajahi Katalog Infrastruktur <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- 2. Custom Development --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-gray-50 border-y border-gray-100">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="w-16 h-16 bg-purple-600 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-purple-500/30">
                    <i class="ri-code-s-slash-line"></i>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Pengembangan <span class="text-purple-600">Kustom</span></h2>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    Setiap bisnis memiliki keunikan alur kerjanya masing-masing. Tim engineering kami siap membangun aplikasi mobile, web, dan sistem terintegrasi yang sepenuhnya disesuaikan untuk memecahkan masalah operasional Anda.
                </p>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <i class="ri-check-line text-purple-600 text-xl mt-0.5"></i>
                        <div>
                            <span class="block font-bold text-gray-900">Aplikasi Mobile iOS & Android</span>
                            <span class="text-sm text-gray-600">Aplikasi native & hybrid dengan UI/UX modern.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-check-line text-purple-600 text-xl mt-0.5"></i>
                        <div>
                            <span class="block font-bold text-gray-900">Progressive Web Apps (PWA)</span>
                            <span class="text-sm text-gray-600">Sistem informasi berbasis web yang responsif dan cepat.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-check-line text-purple-600 text-xl mt-0.5"></i>
                        <div>
                            <span class="block font-bold text-gray-900">API & Microservices</span>
                            <span class="text-sm text-gray-600">Arsitektur modern untuk skalabilitas tinggi.</span>
                        </div>
                    </li>
                </ul>

                <a href="{{ url('/portfolio') }}" class="inline-flex items-center gap-2 text-purple-600 font-semibold hover:text-purple-700 transition">
                    Lihat Hasil Karya Kami <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-purple-100 rounded-full blur-[80px] opacity-60"></div>
                <div class="relative grid grid-cols-2 gap-4">
                    <div class="space-y-4 translate-y-8">
                        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-purple-900/5 border border-gray-100">
                            <i class="ri-smartphone-line text-4xl text-purple-600 mb-4 block"></i>
                            <h4 class="font-bold text-gray-900">Mobile Apps</h4>
                        </div>
                        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-purple-900/5 border border-gray-100">
                            <i class="ri-layout-4-line text-4xl text-purple-600 mb-4 block"></i>
                            <h4 class="font-bold text-gray-900">UI/UX Design</h4>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-purple-900/5 border border-gray-100">
                            <i class="ri-macbook-line text-4xl text-purple-600 mb-4 block"></i>
                            <h4 class="font-bold text-gray-900">Web Dashboard</h4>
                        </div>
                        <div class="bg-purple-600 p-6 rounded-3xl shadow-xl shadow-purple-900/20 text-white">
                            <i class="ri-braces-line text-4xl mb-4 block text-purple-200"></i>
                            <h4 class="font-bold">RESTful API</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Konsultasi & Strategi --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative">
                <div class="absolute inset-0 bg-cyan-100 rounded-full blur-[80px] opacity-60"></div>
                <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-8 sm:p-10 shadow-2xl text-white">
                    <h3 class="text-2xl font-bold mb-8">Kerangka Kerja Konsultasi</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 font-bold border border-cyan-500/30">1</div>
                            <div>
                                <h4 class="font-bold text-lg">Assessment</h4>
                                <p class="text-gray-400 text-sm">Audit menyeluruh terhadap sistem berjalan.</p>
                            </div>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-700 ml-6"></div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 font-bold border border-cyan-500/30">2</div>
                            <div>
                                <h4 class="font-bold text-lg">Strategi & Blueprint</h4>
                                <p class="text-gray-400 text-sm">Pembuatan peta jalan transformasi.</p>
                            </div>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-700 ml-6"></div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-cyan-500 text-white flex items-center justify-center font-bold shadow-lg shadow-cyan-500/30">3</div>
                            <div>
                                <h4 class="font-bold text-lg text-cyan-400">Eksekusi & Monitoring</h4>
                                <p class="text-gray-300 text-sm">Implementasi dengan framework OKR/KPI.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                <div class="w-16 h-16 bg-cyan-500 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-cyan-500/30">
                    <i class="ri-bar-chart-2-line"></i>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Konsultasi IT & <span class="text-cyan-600">Strategi Bisnis</span></h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    Teknologi terbaik sekalipun membutuhkan strategi implementasi yang tepat. Kami tidak hanya menyediakan alat, tetapi juga memandu manajemen Anda dalam proses adopsi teknologi melalui perencanaan strategis.
                </p>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    Kami membantu perusahaan melakukan penilaian infrastruktur TI, integrasi sistem enterprise, serta membangun sistem pemantauan kinerja sumber daya manusia (HR) berbasis KPI dan OKR yang objektif.
                </p>
                
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 text-cyan-600 font-semibold hover:text-cyan-700 transition">
                    Jadwalkan Sesi Konsultasi <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA BOTTOM --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-[#0a192f] relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-500 rounded-full blur-[120px]"></div>
        </div>
        
        <div class="max-w-4xl mx-auto text-center relative z-10 text-white">
            <h2 class="text-3xl md:text-4xl font-bold leading-tight">
                Siap Melakukan Lompatan Digital?
            </h2>
            <p class="text-blue-100 mt-4 max-w-xl mx-auto text-lg font-light leading-relaxed">
                Diskusikan kebutuhan infrastruktur dan perangkat lunak Anda bersama para ahli kami hari ini.
            </p>
            <div class="flex gap-4 justify-center mt-10 flex-wrap">
                <a href="https://wa.me/6281289537549?text=Halo%20Tim%20Sales%20FutureCloud%2C%20saya%20tertarik%20dengan%20layanan%20Anda%20dan%20ingin%20berkonsultasi.%20Terima%20kasih."
                    target="_blank"
                    class="px-8 py-3.5 bg-blue-600 text-white rounded-full shadow-lg shadow-blue-600/30 font-semibold hover:bg-blue-700 transition hover:-translate-y-1 flex items-center gap-2">
                    <i class="ri-whatsapp-line text-xl"></i> Konsultasi via WhatsApp
                </a>
                <a href="{{ url('/contact') }}"
                    class="px-8 py-3.5 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full font-semibold hover:bg-white/20 transition hover:-translate-y-1 flex items-center gap-2">
                    <i class="ri-mail-send-line text-xl"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

@endsection
