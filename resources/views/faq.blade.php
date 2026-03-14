@extends('layouts.landing')
@section('title', 'FAQ')

@section('content')
<main class="bg-slate-50 min-h-screen pb-24">
    
    <div class="pt-24 pb-12 px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">
            <span class="text-slate-900">Pertanyaan yang </span>
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Sering Diajukan</span>
        </h1>
        <p class="text-slate-500 text-base md:text-lg max-w-2xl mx-auto font-medium">
            Temukan jawaban atas pertanyaan umum seputar layanan cloud dan server di FutureCloud.
        </p>
    </div>

    <div class="max-w-[850px] mx-auto px-4 sm:px-6" x-data="{ active: null }">
        <div class="space-y-4">

            <div class="bg-white rounded-2xl border transition-colors duration-300 cursor-pointer" 
                 :class="active === 1 ? 'border-blue-300 shadow-md' : 'border-slate-200 shadow-sm hover:border-blue-200'" 
                 @click="active = active === 1 ? null : 1">
                <div class="px-6 py-5 flex items-center justify-between gap-4">
                    <h3 class="font-semibold text-slate-900 text-[15px] md:text-base leading-snug" :class="active === 1 ? 'text-blue-700' : ''">
                        Apa itu FutureCloud?
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0 transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-blue-500' : 'text-slate-400'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="grid transition-all duration-300 ease-in-out px-6" :class="active === 1 ? 'grid-rows-[1fr] opacity-100 pb-5' : 'grid-rows-[0fr] opacity-0 pb-0'">
                    <div class="overflow-hidden">
                        <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                            FutureCloud adalah platform penyedia layanan komputasi awan, Virtual Private Server (VPS), Hosting Terkelola (cPanel/CyberPanel), dan registrasi Domain untuk membantu infrastruktur digital dan bisnis Anda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border transition-colors duration-300 cursor-pointer" 
                 :class="active === 2 ? 'border-blue-300 shadow-md' : 'border-slate-200 shadow-sm hover:border-blue-200'" 
                 @click="active = active === 2 ? null : 2">
                <div class="px-6 py-5 flex items-center justify-between gap-4">
                    <h3 class="font-semibold text-slate-900 text-[15px] md:text-base leading-snug" :class="active === 2 ? 'text-blue-700' : ''">
                        Berapa lama waktu aktivasi Server/VPS setelah pembayaran?
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0 transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-blue-500' : 'text-slate-400'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="grid transition-all duration-300 ease-in-out px-6" :class="active === 2 ? 'grid-rows-[1fr] opacity-100 pb-5' : 'grid-rows-[0fr] opacity-0 pb-0'">
                    <div class="overflow-hidden">
                        <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                            FutureCloud menggunakan sistem provisioning otomatis. Segera setelah pembayaran Anda terverifikasi oleh Payment Gateway, layanan VPS, cPanel, atau SaaS Anda akan langsung dibuat dalam hitungan 1-3 menit dan siap digunakan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border transition-colors duration-300 cursor-pointer" 
                 :class="active === 3 ? 'border-blue-300 shadow-md' : 'border-slate-200 shadow-sm hover:border-blue-200'" 
                 @click="active = active === 3 ? null : 3">
                <div class="px-6 py-5 flex items-center justify-between gap-4">
                    <h3 class="font-semibold text-slate-900 text-[15px] md:text-base leading-snug" :class="active === 3 ? 'text-blue-700' : ''">
                        Metode pembayaran apa saja yang disediakan?
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0 transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-blue-500' : 'text-slate-400'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="grid transition-all duration-300 ease-in-out px-6" :class="active === 3 ? 'grid-rows-[1fr] opacity-100 pb-5' : 'grid-rows-[0fr] opacity-0 pb-0'">
                    <div class="overflow-hidden">
                        <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                            Kami bekerja sama dengan Payment Gateway lokal, sehingga Anda dapat melakukan pembayaran instan via Transfer Bank (Virtual Account Mandiri, BCA, BRI, BNI), QRIS, serta layanan e-Wallet pilihan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border transition-colors duration-300 cursor-pointer" 
                 :class="active === 4 ? 'border-blue-300 shadow-md' : 'border-slate-200 shadow-sm hover:border-blue-200'" 
                 @click="active = active === 4 ? null : 4">
                <div class="px-6 py-5 flex items-center justify-between gap-4">
                    <h3 class="font-semibold text-slate-900 text-[15px] md:text-base leading-snug" :class="active === 4 ? 'text-blue-700' : ''">
                        Bisakah saya melakukan Upgrade Layanan nanti?
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0 transition-transform duration-300" :class="active === 4 ? 'rotate-180 text-blue-500' : 'text-slate-400'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="grid transition-all duration-300 ease-in-out px-6" :class="active === 4 ? 'grid-rows-[1fr] opacity-100 pb-5' : 'grid-rows-[0fr] opacity-0 pb-0'">
                    <div class="overflow-hidden">
                        <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                            Tentu saja! Keunggulan dari layanan cloud adalah skalabilitas. Anda dapat meng-upgrade paket VPS atau kapasitas Hosting Anda kapan saja melalui dashboard Client Area tanpa khawatir kehilangan data.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border transition-colors duration-300 cursor-pointer" 
                 :class="active === 5 ? 'border-blue-300 shadow-md' : 'border-slate-200 shadow-sm hover:border-blue-200'" 
                 @click="active = active === 5 ? null : 5">
                <div class="px-6 py-5 flex items-center justify-between gap-4">
                    <h3 class="font-semibold text-slate-900 text-[15px] md:text-base leading-snug" :class="active === 5 ? 'text-blue-700' : ''">
                        Apakah FutureCloud menyediakan dukungan/bantuan teknis?
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0 transition-transform duration-300" :class="active === 5 ? 'rotate-180 text-blue-500' : 'text-slate-400'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="grid transition-all duration-300 ease-in-out px-6" :class="active === 5 ? 'grid-rows-[1fr] opacity-100 pb-5' : 'grid-rows-[0fr] opacity-0 pb-0'">
                    <div class="overflow-hidden">
                        <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                            Ya, tim Customer Service dan Support Engineer kami siap membantu kendala Anda. Anda bisa membuat Tiket Dukungan (Support Ticket) di halaman Dashboard, atau langsung chat kami melalui Widget Chatbot di pojok kanan bawah layar.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection