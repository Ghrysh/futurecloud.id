@extends('layouts.landing')

@section('title', 'Instruksi Pembayaran')

@section('content')
<div class="pt-28 pb-20 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full px-4">
        
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Header Biru --}}
            <div class="bg-blue-600 px-6 py-4 text-center">
                <h2 class="text-white font-bold text-xl">Instruksi Pembayaran</h2>
                <p class="text-blue-100 text-sm">Invoice #{{ $order->invoice_number }}</p>
            </div>

            <div class="p-8 text-center">
                <p class="text-gray-600 mb-2">Silakan transfer sejumlah:</p>
                
                {{-- Nominal Copyable --}}
                <div class="text-3xl font-extrabold text-gray-900 mb-6 flex justify-center items-center gap-2 cursor-pointer group" onclick="copyToClipboard('{{ $order->total_amount }}')">
                    <span class="group-hover:text-blue-600 transition">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    <i class="ri-file-copy-line text-gray-400 text-lg group-hover:text-blue-600"></i>
                </div>

                {{-- Area Informasi Rekening --}}
                <div class="border-t border-b border-gray-100 py-6 mb-6">
                    @if($order->payment_method == 'qris_manual' || $order->payment_method == 'qris')
                        {{-- TAMPILAN QRIS --}}
                        <h3 class="font-bold text-gray-800 mb-4">Scan QRIS Berikut:</h3>
                        <div class="w-64 h-64 bg-white mx-auto rounded-lg flex items-center justify-center border-2 border-gray-300 p-2 shadow-sm">
                            {{-- Pastikan gambar ini ada di public/assets/qris.jpg --}}
                            <img src="{{ asset('assets/qris.jpg') }}" alt="QRIS Code" class="w-full h-full object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Menerima BCA, GoPay, OVO, Dana, LinkAja</p>

                    @elseif($order->payment_method == 'bank_bni' || $order->payment_method == 'va_bni')
                        {{-- TAMPILAN BNI --}}
                        <h3 class="font-bold text-gray-800 mb-4">Transfer ke Bank BNI:</h3>
                        
                        {{-- LOGO BARU (CDN STABIL) --}}
                        <img src="{{ asset('assets/bni.png') }}" class="payment-logo h-12 mx-auto mb-5 object-contai" alt="BNI">
                        
                        <div class="bg-blue-50 border border-blue-100 p-5 rounded-xl inline-block text-left w-full max-w-sm">
                            {{-- ... kode rekening tetap sama ... --}}
                            <p class="text-xs text-blue-600 font-semibold mb-1 uppercase tracking-wide">Nomor Rekening</p>
                            <div class="text-2xl font-mono font-bold text-gray-800 flex justify-between items-center">
                                <span id="rek-bni">1813197382</span> 
                                <button onclick="copyToClipboard('1813197382')" class="text-blue-600 hover:bg-blue-100 p-2 rounded transition" title="Salin">
                                    <i class="ri-file-copy-line"></i>
                                </button>
                            </div>
                            <div class="mt-3 pt-3 border-t border-blue-200">
                                <p class="text-xs text-blue-600 font-semibold mb-1">Atas Nama</p>
                                <p class="text-sm font-bold text-gray-800 uppercase">BERKAH TEKNOLOGI TERDEPAN</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- LOGIKA EMAIL TEMPLATE --}}
                @php
                    $emailTo = "ptbtt01@gmail.com";
                    $subject = "Konfirmasi Pembayaran Invoice #" . $order->invoice_number;
                    
                    // Isi Pesan
                    $text  = "Halo Admin FutureCloud,\n\n";
                    $text .= "Saya telah melakukan pembayaran untuk pesanan berikut:\n";
                    $text .= "------------------------------------------------\n";
                    $text .= "No. Invoice : " . $order->invoice_number . "\n";
                    $text .= "Total Bayar : Rp " . number_format($order->total_amount, 0, ',', '.') . "\n";
                    $text .= "Metode      : " . ucfirst(str_replace('_', ' ', $order->payment_method)) . "\n";
                    $text .= "------------------------------------------------\n\n";
                    $text .= "Terlampir bukti transfer pada email ini.\n";
                    $text .= "Mohon segera diproses agar layanan aktif.\n\n";
                    $text .= "Terima kasih,\n";
                    $text .= Auth::user()->name;

                    // 1. Link untuk Aplikasi Email (Outlook/HP)
                    $mailtoLink = "mailto:$emailTo?subject=" . rawurlencode($subject) . "&body=" . rawurlencode($text);

                    // 2. Link Khusus Gmail Web (Untuk user PC/Laptop)
                    $gmailLink = "https://mail.google.com/mail/?view=cm&fs=1&to=$emailTo&su=" . rawurlencode($subject) . "&body=" . rawurlencode($text);
                @endphp

                <div class="space-y-3">
                    <p class="text-sm text-gray-500 font-medium">Sudah melakukan pembayaran? Konfirmasi sekarang:</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        {{-- OPSI 1: APLIKASI EMAIL (HP/Outlook) --}}
                        <a href="{{ $mailtoLink }}" class="flex items-center justify-center gap-2 py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition border border-gray-300">
                            <i class="ri-mail-line text-lg"></i> Aplikasi Email
                        </a>

                        {{-- OPSI 2: GMAIL WEB (Browser) --}}
                        <a href="{{ $gmailLink }}" target="_blank" class="flex items-center justify-center gap-2 py-3 px-4 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition border border-red-200">
                            <i class="ri-google-fill text-lg"></i> Gmail Web
                        </a>
                    </div>
                    
                    {{-- TEXT MANUAL COPY (JAGA-JAGA JIKA TOMBOL GAGAL) --}}
                    <div class="bg-blue-50 p-3 rounded-lg text-xs text-gray-600 mt-4 text-left">
                        <p class="mb-1 font-bold">Jika tombol di atas tidak berfungsi:</p>
                        <p>Kirim email manual ke: <strong class="select-all">ptbtt01@gmail.com</strong></p>
                        <p>Subjek: <span class="select-all font-mono">{{ $subject }}</span></p>
                        <p class="mt-1 text-gray-400 italic">*Jangan lupa lampirkan foto bukti transfer.</p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-gray-100">
                        <a href="{{ route('client.invoices') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 hover:underline">
                            Cek Status di Client Area
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        // Custom Alert yang lebih halus (Opsional)
        // alert('Disalin: ' + text); 
        
        // Ganti text sementara button copy (Feedback Visual)
        const btn = document.activeElement;
        const originalHtml = btn.innerHTML;
        // Cek jika yang diklik adalah icon
        if(btn.tagName === 'I' || btn.tagName === 'SPAN') return; 
        
        // Simple feedback
        alert("Nomor/Nominal berhasil disalin!");
    }
</script>
@endsection