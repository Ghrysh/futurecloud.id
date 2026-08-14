@extends('layouts.landing')

@section('title', 'Refund Policy')

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/refund-hero.jpg') }}" alt="Refund Background" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-10 right-10 w-64 h-64 bg-cyan-600 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-10 left-10 w-48 h-48 bg-blue-400 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Informasi Legal</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Kebijakan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Pengembalian Dana</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Terakhir diperbarui: {{ date('d F Y') }}
            </p>
        </div>
    </section>

    {{-- REFUND CONTENT --}}
    <main class="w-full py-24 bg-slate-50 min-h-screen relative font-['Inter']">
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-[900px] mx-auto px-4 sm:px-6 relative z-10 space-y-8">

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">1</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Ketentuan Umum</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    PT Berkah Teknologi Terdepan ("Kami") berkomitmen memberikan performa server dan layanan cloud terbaik kepada seluruh pelanggan FutureCloud. Kebijakan pengembalian dana (refund) ini dibuat untuk memastikan transparansi atas setiap transaksi Anda.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center shrink-0 border border-green-100">
                        <span class="text-xl font-black text-green-600">2</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Kriteria Pengajuan Refund</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium mb-4">
                    Dana Anda dapat dikembalikan apabila memenuhi satu atau lebih kondisi berikut:
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="ri-checkbox-circle-fill text-green-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Terjadi penagihan ganda (double payment) karena kesalahan sistem payment gateway kami.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-checkbox-circle-fill text-green-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Layanan Cloud/VPS/Hosting yang Anda pesan gagal dibuat (deploy) oleh sistem kami dalam waktu lebih dari 3x24 jam setelah pembayaran lunas.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-checkbox-circle-fill text-green-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Pihak FutureCloud memutuskan untuk menghentikan operasional layanan tertentu secara sepihak di mana Anda masih memiliki sisa saldo atau sisa masa sewa yang aktif.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center shrink-0 border border-red-100">
                        <span class="text-xl font-black text-red-600">3</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Pengecualian Layanan (Non-Refundable)</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium mb-4">
                    Kami <b>TIDAK</b> dapat memproses permintaan pengembalian dana untuk hal-hal di bawah ini:
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium"><b>Registrasi & Transfer Domain:</b> Segala transaksi pendaftaran nama domain bersifat final dan permanen karena pembayaran diteruskan langsung ke Otoritas Registrar Internasional.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Layanan server atau VPS yang ditangguhkan/dihapus karena pengguna melanggar Syarat & Ketentuan (misal: digunakan untuk Phishing, DDoS, dll).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Pengguna salah memilih sistem operasi (OS) saat order, yang mana hal ini bisa diatasi dengan melakukan reinstall server secara gratis melalui dashboard.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">4</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Prosedur Pengajuan</h2>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 font-bold mt-1">1</div>
                        <p class="text-base text-slate-600 leading-relaxed font-medium">
                            Kirimkan email permintaan ke <a href="mailto:support@futurecloud.id" class="text-blue-600 font-bold hover:underline transition-all">support@futurecloud.id</a> atau buat Tiket Bantuan dengan subjek "Pengembalian Dana - [Invoice ID]".
                        </p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 font-bold mt-1">2</div>
                        <p class="text-base text-slate-600 leading-relaxed font-medium">
                            Jelaskan alasan refund dan sertakan bukti transfer/pembayaran.
                        </p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 font-bold mt-1">3</div>
                        <p class="text-base text-slate-600 leading-relaxed font-medium">
                            Tim kami akan mengevaluasi permintaan Anda maksimal dalam 3-5 hari kerja.
                        </p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 text-blue-600 font-bold mt-1">4</div>
                        <p class="text-base text-slate-600 leading-relaxed font-medium">
                            Jika disetujui, dana akan dikirimkan ke rekening bank atau e-wallet yang Anda berikan (proses transfer memakan waktu 7-14 hari kerja).
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
