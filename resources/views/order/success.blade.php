@extends('layouts.landing')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        
        <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8 text-center relative overflow-hidden">
            {{-- Hiasan Confetti CSS Sederhana --}}
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 via-blue-500 to-purple-600"></div>

            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="ri-checkbox-circle-fill text-6xl text-green-500"></i>
            </div>

            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Order Diterima!</h1>
            <p class="text-gray-500 mb-8">Terima kasih, pesanan Anda sedang diproses sistem.</p>

            <div class="bg-gray-50 rounded-xl p-6 mb-8 text-left border border-gray-100">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500 text-sm">No. Invoice</span>
                    <span class="font-mono font-bold text-gray-800">{{ $order->invoice_number }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500 text-sm">Metode Bayar</span>
                    <span class="font-bold text-gray-800 uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500 text-sm">Total Bayar</span>
                    <span class="font-extrabold text-blue-600 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <p class="text-xs text-center text-gray-400">Silakan cek email Anda untuk detail instruksi pembayaran jika belum otomatis.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('client.dashboard') }}" class="py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">
                    Ke Client Area
                </a>
                <a href="{{ url('/') }}" class="py-3 px-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                    Belanja Lagi
                </a>
            </div>

        </div>

    </div>
</div>
@endsection