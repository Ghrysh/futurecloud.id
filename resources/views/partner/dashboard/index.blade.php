@extends('layouts.partner-app') {{-- Gunakan Layout Baru --}}

@section('title', 'Overview')
@section('header_title', 'Dashboard Overview')

@section('content')
    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Aplikasi</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalApps }}</h3>
                </div>
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="ri-apps-line text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Aplikasi Live</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-1">{{ $activeApps }}</h3>
                </div>
                <div class="p-2 bg-green-50 text-green-600 rounded-lg">
                    <i class="ri-checkbox-circle-line text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Pending Review</p>
                    <h3 class="text-3xl font-bold text-yellow-600 mt-1">{{ $pendingApps }}</h3>
                </div>
                <div class="p-2 bg-yellow-50 text-yellow-600 rounded-lg">
                    <i class="ri-time-line text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Cepat --}}
    <div class="bg-purple-600 rounded-2xl p-8 text-white flex flex-col md:flex-row items-center justify-between shadow-lg">
        <div>
            <h3 class="text-xl font-bold mb-1">Upload Aplikasi Baru</h3>
            <p class="text-purple-100 text-sm">Jangkau lebih banyak pelanggan dengan menambahkan produk SaaS Anda.</p>
        </div>
        <a href="{{ route('partner.saas.create') }}" class="mt-4 md:mt-0 px-6 py-3 bg-white text-purple-700 font-bold rounded-xl hover:bg-gray-100 transition shadow-md">
            + Tambah Aplikasi
        </a>
    </div>
@endsection