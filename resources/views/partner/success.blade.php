@extends('layouts.landing')

@section('title', 'Pendaftaran Berhasil')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-20 flex items-center justify-center px-4">
    
    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-10 text-center relative overflow-hidden">
        
        {{-- Dekorasi Confetti (CSS Only) --}}
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-green-400 to-blue-500"></div>

        {{-- Ikon Sukses --}}
        <div class="mb-8 flex justify-center">
            <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center relative">
                <div class="absolute w-full h-full rounded-full bg-green-400/20 animate-ping"></div>
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center relative z-10">
                    <i class="ri-check-line text-5xl text-green-600 font-bold"></i>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-4 tracking-tight">Pendaftaran Berhasil!</h1>
        
        <p class="text-gray-600 mb-8 leading-relaxed">
            Aplikasi SaaS Anda telah berhasil dikirim ke sistem kami. Terima kasih telah memilih <span class="font-bold text-blue-600">FutureCloud</span> sebagai partner pertumbuhan bisnis Anda.
        </p>

        {{-- Status Box --}}
        <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 mb-8 text-left flex items-start gap-3">
            <i class="ri-time-line text-yellow-600 text-xl mt-0.5"></i>
            <div>
                <p class="text-sm font-bold text-yellow-800">Status: Pending Review</p>
                <p class="text-xs text-yellow-700 mt-1">Tim kami sedang meninjau aplikasi Anda. Proses ini biasanya memakan waktu 1x24 jam kerja.</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="{{ route('client.dashboard') }}" 
               class="flex items-center justify-center w-full py-3.5 bg-blue-600 text-white rounded-xl font-bold text-base hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200 transform hover:-translate-y-0.5 gap-2">
                <i class="ri-dashboard-3-line"></i> Masuk ke Dashboard
            </a>
            
            <a href="{{ route('home') }}" 
               class="block w-full py-3.5 bg-white text-gray-600 border border-gray-200 rounded-xl font-semibold hover:bg-gray-50 hover:text-gray-900 transition">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection