@extends('layouts.landing')

@section('title', 'Instruksi Pembayaran')

@section('content')
<div class="pt-28 pb-20 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full px-4">
        
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Header Biru --}}
            <div class="bg-blue-600 px-6 py-4 text-center">
                <h2 class="text-white font-bold text-xl">Instruksi Pembayaran</h2>
                <p class="text-blue-100 text-sm mb-2">Invoice #{{ $order->invoice_number }}</p>
                <div class="bg-blue-700/50 rounded-lg inline-block px-4 py-2 text-white font-bold mt-2">
                    Batas Waktu: <span id="countdown_timer">--:--:--</span>
                </div>
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


                <div class="space-y-4">
                    <p class="text-sm text-gray-800 font-bold">Langkah Selanjutnya: Unggah Bukti Transfer</p>
                    
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-4 text-sm font-semibold border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($order->payment_proof)
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-left mb-6">
                            <p class="text-sm font-bold text-blue-800 mb-2 text-center">Bukti Pembayaran Saat Ini:</p>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full max-w-xs mx-auto rounded-lg shadow-sm border border-gray-200 mb-3">
                            <p class="text-xs text-blue-600 text-center">Anda dapat mengunggah ulang jika ada kesalahan gambar.</p>
                        </div>
                    @endif

                    <form id="paymentProofForm" action="{{ route('order.upload_proof', $order->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 border border-gray-200 p-5 rounded-xl text-left mb-6">
                        @csrf
                        <div class="mb-4 text-left">
                            <label class="block text-sm font-bold text-gray-700 mb-2">File Bukti Transfer (JPG/PNG)</label>
                            <input type="file" name="payment_proof" id="payment_proof_input" accept="image/jpeg,image/png" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md p-1 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Maksimal ukuran file: 5 MB</p>
                        </div>
                        @error('payment_proof')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="mt-4 w-full bg-blue-600 text-white font-bold py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <i class="ri-upload-cloud-2-line text-lg"></i> Unggah Bukti
                        </button>
                    </form>

                    <div class="pt-4 mt-6 border-t border-gray-100">
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
        customAlert("Nomor/Nominal berhasil disalin!")
    }

    // JS File Size Validation (Max 5MB)
    const paymentForm = document.getElementById('paymentProofForm');
    const paymentInput = document.getElementById('payment_proof_input');
    
    if (paymentForm && paymentInput) {
        paymentForm.addEventListener('submit', function(e) {
            if (paymentInput.files.length > 0) {
                const fileSize = paymentInput.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 5) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Ukuran Terlalu Besar!',
                        text: 'Ukuran gambar maksimal adalah 5 MB. Harap perkecil (compress) gambar Anda sebelum mengunggah.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

    // Countdown Timer Logic
    const createdAt = new Date("{{ $order->created_at->toIso8601String() }}").getTime();
    const expireTime = createdAt + (24 * 60 * 60 * 1000); // 24 hours in milliseconds

    const countdownInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = expireTime - now;

        if (distance < 0) {
            clearInterval(countdownInterval);
            document.getElementById("countdown_timer").innerHTML = "KEDALUWARSA";
            Swal.fire({
                title: 'Waktu Habis!',
                text: 'Pesanan ini sudah kedaluwarsa karena melewati batas 24 jam. Halaman akan dimuat ulang.',
                icon: 'warning',
                confirmButtonText: 'Kembali',
                allowOutsideClick: false
            }).then(() => {
                window.location.href = "{{ route('client.invoices') }}";
            });
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown_timer").innerHTML = 
            (hours < 10 ? "0" + hours : hours) + "j " + 
            (minutes < 10 ? "0" + minutes : minutes) + "m " + 
            (seconds < 10 ? "0" + seconds : seconds) + "d";
    }, 1000);
</script>
@endsection