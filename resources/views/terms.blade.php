@extends('layouts.app') 
@section('content')
<main class="bg-slate-50 min-h-screen font-['Inter'] pb-24">
    
    <div class="pt-24 pb-12 px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">
            <span class="text-slate-900">Syarat & </span>
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Ketentuan</span>
        </h1>
        <p class="text-slate-500 text-base md:text-lg max-w-2xl mx-auto font-medium">
            Terakhir diperbarui: {{ date('d F Y') }}
        </p>
    </div>

    <div class="max-w-[900px] mx-auto px-4 sm:px-6 space-y-6">

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">1. Pendahuluan</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                Selamat datang di FutureCloud, platform layanan infrastruktur digital yang dikelola oleh PT Berkah Teknologi Terdepan. Dengan mengakses, mendaftar, dan menggunakan layanan kami, Anda setuju untuk terikat oleh Syarat & Ketentuan ini. Jika Anda tidak setuju, Anda dilarang menggunakan layanan kami.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">2. Layanan Kami</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                FutureCloud menyediakan penyewaan Cloud, Virtual Private Server (VPS), Domain, Hosting Terkelola, serta layanan SaaS (Software as a Service) lainnya. Kami berhak mengubah spesifikasi, menangguhkan, atau menghentikan layanan kapan saja untuk pemeliharaan atau alasan teknis.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">3. Akun dan Keamanan</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                Anda bertanggung jawab penuh untuk memberikan informasi yang valid saat pendaftaran dan menjaga kerahasiaan kredensial login (Email & Password) Anda. FutureCloud tidak bertanggung jawab atas akses yang tidak sah ke dalam server atau akun Anda akibat kelalaian pelanggan.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">4. Pembayaran dan Tagihan</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                Sistem kami menggunakan sistem prabayar (pre-paid). Layanan berbayar ditagihkan sesuai dengan siklus yang Anda pilih. Jika pembayaran tidak diterima selambat-lambatnya pada tanggal jatuh tempo, layanan Anda (VPS/Hosting/Domain) akan ditangguhkan dan dihapus dari sistem secara otomatis.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">5. Penggunaan yang Dilarang</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium mb-3">
                Dengan menyewa server atau menggunakan layanan di FutureCloud, Anda dilarang keras untuk:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                <li>Menggunakan layanan untuk tujuan ilegal atau melanggar hukum Republik Indonesia dan Internasional.</li>
                <li>Menyebarkan malware, ransomware, botnet, atau aktivitas peretasan (hacking, port scanning, DDoS).</li>
                <li>Melakukan spam email atau pengiriman pesan massal yang tidak sah.</li>
                <li>Meng-host web phising, penipuan, perjudian online, atau konten bajakan tanpa lisensi.</li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">6. Penghentian Layanan & Sanksi</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                FutureCloud berhak membatalkan, mensuspend, atau menghapus layanan (Server/Hosting) secara sepihak dan tanpa peringatan apabila ditemukan adanya pelanggaran berat terhadap Syarat & Ketentuan ini. Dalam kasus ini, tidak ada pengembalian dana (refund) yang akan diberikan.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">7. Hukum yang Berlaku</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                Syarat & Ketentuan ini tunduk pada hukum Republik Indonesia. Setiap sengketa akan diselesaikan melalui musyawarah untuk mufakat.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
            <h2 class="text-[17px] md:text-[19px] font-bold text-slate-900 mb-4 tracking-tight">8. Kontak Bantuan</h2>
            <p class="text-sm md:text-[15px] text-slate-500 leading-relaxed font-medium">
                PT Berkah Teknologi Terdepan<br>
                Email: <a href="mailto:support@futurecloud.id" class="text-blue-600 font-bold hover:underline">support@futurecloud.id</a><br>
                Gedung Jaya Lomba 5 unit A.6<br>
                Jl. M H Thamrin No.12, RT.002/RW.001<br>
                Kb. Sirih, Kec. Menteng, Jakarta Pusat 10340
            </p>
        </div>

    </div>
</main>
@endsection