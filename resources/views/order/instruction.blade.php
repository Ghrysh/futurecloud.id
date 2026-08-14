@extends('layouts.landing')

@section('title', 'Instruksi Pembayaran')

@section('content')
<div class="pt-28 pb-20 bg-slate-50 min-h-screen flex items-center justify-center font-['Inter'] relative overflow-hidden">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-slate-200 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-2xl w-full px-4 relative z-10 scroll-reveal">
        
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden">
            {{-- Header Biru --}}
            <div class="bg-blue-600 px-8 py-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-2xl -mr-16 -mt-16 pointer-events-none"></div>
                <h2 class="text-white font-extrabold text-2xl relative z-10">Menunggu Pembayaran</h2>
                <p class="text-blue-100 font-medium mb-3 relative z-10">Invoice #{{ $order->invoice_number }}</p>
                <div class="bg-blue-800/40 rounded-xl inline-block px-5 py-2.5 text-white font-bold mt-2 relative z-10 border border-blue-500/30 backdrop-blur-sm">
                    Sisa Waktu: <span id="countdown_timer" class="text-blue-100 font-mono tracking-wider ml-1">--:--:--</span>
                </div>
            </div>

            <div class="p-8 sm:p-10 text-center">
                <p class="text-slate-500 font-medium mb-3 uppercase tracking-wider text-xs">Total yang harus dibayar</p>
                
                {{-- Nominal Copyable --}}
                <div class="text-4xl sm:text-5xl font-black text-blue-600 mb-8 flex justify-center items-center gap-3 cursor-pointer group" onclick="copyToClipboard('{{ $order->total_amount }}')">
                    <span class="group-hover:text-blue-700 transition">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center group-hover:bg-blue-50 group-hover:border-blue-200 transition shrink-0">
                        <i class="ri-file-copy-line text-slate-400 group-hover:text-blue-600"></i>
                    </div>
                </div>

                {{-- Area Informasi Rekening --}}
                <div class="border-y border-slate-100 py-8 mb-8">
                    <h3 class="font-bold text-slate-800 mb-6 text-lg">Transfer ke Rekening Berikut:</h3>
                    
                    <div class="bg-slate-50 border border-slate-200 p-6 rounded-2xl inline-block text-left w-full max-w-sm hover:border-blue-300 transition-colors">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-200">
                            <div class="w-16 h-10 bg-white rounded-lg flex items-center justify-center border border-slate-200 p-1 shrink-0">
                                <img src="{{ asset('assets/bni.webp') }}" class="w-full h-full object-contain" alt="BNI">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Bank BNI</p>
                                <p class="text-xs text-slate-500">Transfer Manual</p>
                            </div>
                        </div>

                        <p class="text-xs text-slate-500 font-bold mb-1 uppercase tracking-wide">Nomor Rekening</p>
                        <div class="text-2xl sm:text-3xl font-mono font-black text-slate-800 flex justify-between items-center tracking-tight mb-4">
                            <span id="rek-bni">1813197382</span> 
                            <button onclick="copyToClipboard('1813197382')" class="text-blue-600 hover:bg-blue-100 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Salin Rekening">
                                <i class="ri-file-copy-line text-lg"></i>
                            </button>
                        </div>
                        
                        <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                            <p class="text-xs text-blue-600 font-bold mb-1 uppercase tracking-wider">Atas Nama</p>
                            <p class="text-sm font-black text-slate-800 uppercase">BERKAH TEKNOLOGI TERDEPAN</p>
                        </div>
                    </div>
                </div>

                {{-- FORM BUKTI TRANSFER --}}
                <div class="space-y-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-600 mb-2">
                        <i class="ri-upload-cloud-2-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg text-slate-900 font-bold">Langkah Terakhir: Unggah Bukti</h3>
                    <p class="text-sm text-slate-500">Pesanan Anda akan diproses segera setelah kami memverifikasi bukti transfer.</p>
                    
                    @if(session('success'))
                        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-bold border border-emerald-200 shadow-sm inline-flex items-center gap-2">
                            <i class="ri-checkbox-circle-fill text-lg"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($order->payment_proof)
                        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl text-center shadow-sm">
                            <p class="text-sm font-bold text-blue-800 mb-4 flex items-center justify-center gap-2">
                                <i class="ri-image-line text-lg"></i> Bukti Pembayaran Saat Ini
                            </p>
                            <div class="bg-white p-2 rounded-xl border border-blue-100 inline-block">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full max-w-xs mx-auto rounded-lg shadow-sm object-cover max-h-64">
                            </div>
                            <p class="text-xs text-blue-600 mt-4 font-medium">Anda dapat mengunggah ulang jika ada kesalahan.</p>
                        </div>
                    @endif

                    <form id="paymentProofForm" action="{{ route('order.upload_proof', $order->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 border border-slate-200 p-6 sm:p-8 rounded-2xl text-left shadow-sm">
                        @csrf
                        <div class="mb-5 text-left">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Pilih File Gambar (JPG/PNG)</label>
                            <input type="file" name="payment_proof" id="payment_proof_input" accept="image/jpeg,image/png" required 
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 file:transition border-2 border-slate-200 rounded-xl bg-white focus:outline-none focus:border-blue-500 transition-colors">
                            <p class="text-xs text-slate-400 mt-2 flex items-center gap-1 font-medium">
                                <i class="ri-information-line"></i> Ukuran maksimal 5 MB.
                            </p>
                        </div>
                        @error('payment_proof')
                            <p class="text-red-500 text-xs font-bold mb-4 flex items-center gap-1"><i class="ri-error-warning-fill"></i> {{ $message }}</p>
                        @enderror
                        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-slate-800 transition-all flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5">
                            Kirim Bukti Pembayaran <i class="ri-send-plane-fill"></i>
                        </button>
                    </form>

                    <div class="pt-6 mt-8 border-t border-slate-100">
                        <a href="{{ route('client.invoices') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition">
                            <i class="ri-arrow-left-line"></i> Kembali ke Client Area
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        
        Swal.fire({
            title: 'Disalin!',
            text: text + ' berhasil disalin ke clipboard.',
            icon: 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
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
                        text: 'Ukuran gambar maksimal adalah 5 MB. Harap perkecil gambar Anda.',
                        icon: 'error',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#2563eb'
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
                text: 'Pesanan ini sudah kedaluwarsa karena melewati batas 24 jam.',
                icon: 'warning',
                confirmButtonText: 'Kembali',
                confirmButtonColor: '#2563eb',
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
