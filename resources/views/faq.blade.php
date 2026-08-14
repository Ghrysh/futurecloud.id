@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/faq-hero.webp') }}" alt="FAQ Background" class="w-full h-full object-cover opacity-20 mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-10 right-1/4 w-48 h-48 bg-blue-500 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 left-1/4 w-64 h-64 bg-purple-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Pusat Bantuan</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Pertanyaan yang <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Sering Diajukan</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Temukan jawaban atas pertanyaan umum seputar layanan cloud dan server di FutureCloud dengan cepat dan mudah.
            </p>
        </div>
    </section>

    {{-- FAQ CONTENT --}}
    <main class="w-full py-24 bg-slate-50 min-h-screen relative">
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-blue-100 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-[850px] mx-auto px-4 sm:px-6 relative z-10" x-data="{ active: null }">
            <div class="space-y-6">

                <div class="bg-white rounded-3xl border transition-all duration-300 cursor-pointer scroll-reveal shadow-lg shadow-blue-900/5" 
                     :class="active === 1 ? 'border-blue-300 ring-4 ring-blue-500/10' : 'border-slate-200 hover:border-blue-300 hover:shadow-xl'" 
                     @click="active = active === 1 ? null : 1">
                    <div class="px-8 py-6 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-slate-900 text-lg md:text-xl leading-snug transition-colors" :class="active === 1 ? 'text-blue-600' : ''">
                            Apa itu FutureCloud?
                        </h3>
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0 transition-transform duration-500" :class="active === 1 ? 'rotate-180 bg-blue-600 text-white shadow-md' : 'text-blue-600'">
                            <i class="ri-arrow-down-s-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-500 ease-in-out px-8" :class="active === 1 ? 'grid-rows-[1fr] opacity-100 pb-8' : 'grid-rows-[0fr] opacity-0 pb-0'">
                        <div class="overflow-hidden">
                            <div class="w-full h-px bg-slate-100 mb-6"></div>
                            <p class="text-base text-slate-600 leading-relaxed">
                                FutureCloud adalah platform penyedia layanan komputasi awan, Virtual Private Server (VPS), Hosting Terkelola (cPanel/CyberPanel), dan registrasi Domain untuk membantu infrastruktur digital dan bisnis Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border transition-all duration-300 cursor-pointer scroll-reveal shadow-lg shadow-blue-900/5" style="transition-delay: 100ms;"
                     :class="active === 2 ? 'border-blue-300 ring-4 ring-blue-500/10' : 'border-slate-200 hover:border-blue-300 hover:shadow-xl'" 
                     @click="active = active === 2 ? null : 2">
                    <div class="px-8 py-6 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-slate-900 text-lg md:text-xl leading-snug transition-colors" :class="active === 2 ? 'text-blue-600' : ''">
                            Berapa lama waktu aktivasi Server/VPS setelah pembayaran?
                        </h3>
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0 transition-transform duration-500" :class="active === 2 ? 'rotate-180 bg-blue-600 text-white shadow-md' : 'text-blue-600'">
                            <i class="ri-arrow-down-s-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-500 ease-in-out px-8" :class="active === 2 ? 'grid-rows-[1fr] opacity-100 pb-8' : 'grid-rows-[0fr] opacity-0 pb-0'">
                        <div class="overflow-hidden">
                            <div class="w-full h-px bg-slate-100 mb-6"></div>
                            <p class="text-base text-slate-600 leading-relaxed">
                                FutureCloud menggunakan sistem provisioning otomatis. Segera setelah pembayaran Anda terverifikasi oleh Payment Gateway, layanan VPS, cPanel, atau SaaS Anda akan langsung dibuat dalam hitungan 1-3 menit dan siap digunakan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border transition-all duration-300 cursor-pointer scroll-reveal shadow-lg shadow-blue-900/5" style="transition-delay: 200ms;"
                     :class="active === 3 ? 'border-blue-300 ring-4 ring-blue-500/10' : 'border-slate-200 hover:border-blue-300 hover:shadow-xl'" 
                     @click="active = active === 3 ? null : 3">
                    <div class="px-8 py-6 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-slate-900 text-lg md:text-xl leading-snug transition-colors" :class="active === 3 ? 'text-blue-600' : ''">
                            Metode pembayaran apa saja yang disediakan?
                        </h3>
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0 transition-transform duration-500" :class="active === 3 ? 'rotate-180 bg-blue-600 text-white shadow-md' : 'text-blue-600'">
                            <i class="ri-arrow-down-s-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-500 ease-in-out px-8" :class="active === 3 ? 'grid-rows-[1fr] opacity-100 pb-8' : 'grid-rows-[0fr] opacity-0 pb-0'">
                        <div class="overflow-hidden">
                            <div class="w-full h-px bg-slate-100 mb-6"></div>
                            <p class="text-base text-slate-600 leading-relaxed">
                                Kami bekerja sama dengan Payment Gateway lokal, sehingga Anda dapat melakukan pembayaran instan via Transfer Bank (Virtual Account Mandiri, BCA, BRI, BNI), QRIS, serta layanan e-Wallet pilihan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border transition-all duration-300 cursor-pointer scroll-reveal shadow-lg shadow-blue-900/5" style="transition-delay: 300ms;"
                     :class="active === 4 ? 'border-blue-300 ring-4 ring-blue-500/10' : 'border-slate-200 hover:border-blue-300 hover:shadow-xl'" 
                     @click="active = active === 4 ? null : 4">
                    <div class="px-8 py-6 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-slate-900 text-lg md:text-xl leading-snug transition-colors" :class="active === 4 ? 'text-blue-600' : ''">
                            Bisakah saya melakukan Upgrade Layanan nanti?
                        </h3>
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0 transition-transform duration-500" :class="active === 4 ? 'rotate-180 bg-blue-600 text-white shadow-md' : 'text-blue-600'">
                            <i class="ri-arrow-down-s-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-500 ease-in-out px-8" :class="active === 4 ? 'grid-rows-[1fr] opacity-100 pb-8' : 'grid-rows-[0fr] opacity-0 pb-0'">
                        <div class="overflow-hidden">
                            <div class="w-full h-px bg-slate-100 mb-6"></div>
                            <p class="text-base text-slate-600 leading-relaxed">
                                Tentu saja! Keunggulan dari layanan cloud adalah skalabilitas. Anda dapat meng-upgrade paket VPS atau kapasitas Hosting Anda kapan saja melalui dashboard Client Area tanpa khawatir kehilangan data.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border transition-all duration-300 cursor-pointer scroll-reveal shadow-lg shadow-blue-900/5" style="transition-delay: 400ms;"
                     :class="active === 5 ? 'border-blue-300 ring-4 ring-blue-500/10' : 'border-slate-200 hover:border-blue-300 hover:shadow-xl'" 
                     @click="active = active === 5 ? null : 5">
                    <div class="px-8 py-6 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-slate-900 text-lg md:text-xl leading-snug transition-colors" :class="active === 5 ? 'text-blue-600' : ''">
                            Apakah FutureCloud menyediakan dukungan/bantuan teknis?
                        </h3>
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0 transition-transform duration-500" :class="active === 5 ? 'rotate-180 bg-blue-600 text-white shadow-md' : 'text-blue-600'">
                            <i class="ri-arrow-down-s-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-500 ease-in-out px-8" :class="active === 5 ? 'grid-rows-[1fr] opacity-100 pb-8' : 'grid-rows-[0fr] opacity-0 pb-0'">
                        <div class="overflow-hidden">
                            <div class="w-full h-px bg-slate-100 mb-6"></div>
                            <p class="text-base text-slate-600 leading-relaxed">
                                Ya, tim Customer Service dan Support Engineer kami siap membantu kendala Anda. Anda bisa membuat Tiket Dukungan (Support Ticket) di halaman Dashboard, atau langsung chat kami melalui Widget Chatbot di pojok kanan bawah layar.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="mt-16 text-center scroll-reveal" style="transition-delay: 500ms;">
                <p class="text-slate-600 mb-6 text-lg">Masih belum menemukan jawaban yang Anda cari?</p>
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition hover:-translate-y-1">
                    Hubungi Tim Support Kami <i class="ri-customer-service-2-line text-xl"></i>
                </a>
            </div>
        </div>
    </main>

@endsection
