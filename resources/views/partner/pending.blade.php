@extends('layouts.landing')

@section('title', 'Menunggu Persetujuan')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-20 flex items-center justify-center px-4">
    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-10 text-center">
        
        <div class="mb-6 flex justify-center">
            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center animate-pulse">
                <i class="ri-time-line text-4xl text-yellow-600"></i>
            </div>
        </div>

        <h1 class="text-2xl font-extrabold text-gray-900 mb-3">Pendaftaran Sedang Ditinjau</h1>
        
        <p class="text-gray-600 mb-8 leading-relaxed text-sm">
            Data perusahaan Anda sedang diverifikasi oleh Tim Admin FutureCloud. Proses ini biasanya memakan waktu <strong>1x24 jam kerja</strong>. Anda akan menerima notifikasi setelah disetujui.
        </p>

        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-8 text-left flex gap-3">
            <i class="ri-information-fill text-blue-600 mt-0.5"></i>
            <div class="text-xs text-blue-800">
                <p class="font-bold mb-1">Apa selanjutnya?</p>
                <p>Setelah disetujui, menu "Partner Dashboard" akan muncul otomatis di akun Anda, dan Anda bisa mulai mengupload aplikasi.</p>
            </div>
        </div>

        <a href="{{ route('home') }}" class="block w-full py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection