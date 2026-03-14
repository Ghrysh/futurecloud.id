@extends('layouts.landing')
@section('title', 'Refund Policy')

@section('content')
<main class="bg-slate-50 min-h-screen font-['Inter'] pb-24">
    
    <div class="pt-24 pb-12 px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">
            <span class="text-slate-900">Kebijakan </span>
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Pengembalian Dana</span>
        </h1>
        <p class="text-slate-500 text-base md:text-lg max-w-2xl mx-auto font-medium">
            Terakhir diperbarui: {{ date('d F Y') }}
        </p>
    </div>

    <div class="max-w-[900px] mx-auto px-4 sm:px-6 space-y-6">

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">1. Ketentuan Umum</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                PT Berkah Teknologi Terdepan ("Kami") berkomitmen memberikan performa server dan layanan cloud terbaik kepada seluruh pelanggan FutureCloud. Kebijakan pengembalian dana (refund) ini dibuat untuk memastikan transparansi atas setiap transaksi Anda.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">2. Kriteria Pengajuan Refund</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium mb-3">
                Dana Anda dapat dikembalikan apabila memenuhi satu atau lebih kondisi berikut:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                <li>Terjadi penagihan ganda (double payment) karena kesalahan sistem payment gateway kami.</li>
                <li>Layanan Cloud/VPS/Hosting yang Anda pesan gagal dibuat (deploy) oleh sistem kami dalam waktu lebih dari 3x24 jam setelah pembayaran lunas.</li>
                <li>Pihak FutureCloud memutuskan untuk menghentikan operasional layanan tertentu secara sepihak di mana Anda masih memiliki sisa saldo atau sisa masa sewa yang aktif.</li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">3. Pengecualian Layanan (Non-Refundable)</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium mb-3">
                Kami <b>TIDAK</b> dapat memproses permintaan pengembalian dana untuk hal-hal di bawah ini:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                <li><b>Registrasi & Transfer Domain:</b> Segala transaksi pendaftaran nama domain bersifat final dan permanen karena pembayaran diteruskan langsung ke Otoritas Registrar Internasional.</li>
                <li>Layanan server atau VPS yang ditangguhkan/dihapus karena pengguna melanggar Syarat & Ketentuan (misal: digunakan untuk Phishing, DDoS, dll).</li>
                <li>Pengguna salah memilih sistem operasi (OS) saat order, yang mana hal ini bisa diatasi dengan melakukan reinstall server secara gratis melalui dashboard.</li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">4. Prosedur Pengajuan</h2>
            <div class="space-y-3 text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                <p>1. Kirimkan email permintaan ke <a href="mailto:support@futurecloud.id" class="text-blue-600 font-bold hover:underline transition-all">support@futurecloud.id</a> atau buat Tiket Bantuan dengan subjek "Pengembalian Dana - [Invoice ID]".</p>
                <p>2. Jelaskan alasan refund dan sertakan bukti transfer/pembayaran.</p>
                <p>3. Tim kami akan mengevaluasi permintaan Anda maksimal dalam 3-5 hari kerja.</p>
                <p>4. Jika disetujui, dana akan dikirimkan ke rekening bank atau e-wallet yang Anda berikan (proses transfer memakan waktu 7-14 hari kerja).</p>
            </div>
        </div>

    </div>
</main>
@endsection