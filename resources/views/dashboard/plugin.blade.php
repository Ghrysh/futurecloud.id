@extends('layouts.client-app')

@section('title', 'Plugin Saya')

@section('content')

<div class="space-y-6">
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Plugin Saya</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola lisensi dan integrasi plugin ke dalam project Anda.</p>
        </div>
    </div>

    <!-- PLUGIN LIST -->
    @if($plugins->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-plug-line text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada plugin</h3>
            <p class="text-gray-500 text-sm mb-4">Anda belum memiliki produk plugin yang aktif.</p>
            <a href="{{ route('saas.detail') }}" class="btn-action inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                <i class="ri-shopping-bag-line"></i> Beli Plugin
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($plugins as $plugin)
                @php
                    $config = $plugin->configuration ?? [];
                    if(is_string($config)) {
                        $config = json_decode($config, true) ?? [];
                    }
                    $licenseKey = $config['license_key'] ?? 'Belum Dibuat (Hubungi Admin)';
                    
                    $isChatbot = str_contains(strtolower($plugin->product_name), 'chatbot');
                    $cliCommand = $isChatbot ? 'chatbot' : 'monitoring';
                    $cliShort = $isChatbot ? 'cb' : 'm';
                @endphp

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-2xl">
                                <i class="ri-plug-line"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $plugin->product_name }}</h3>
                                <p class="text-xs text-gray-500">Dibeli pada: {{ $plugin->created_at->format('d M Y') }}</p>
                                @php $expiredAt = $config['expired_at'] ?? null; @endphp
                                @if($expiredAt)
                                    <p class="text-xs {{ \Carbon\Carbon::parse($expiredAt)->isPast() ? 'text-red-500 font-bold' : 'text-orange-500' }}">Berlaku s/d: {{ \Carbon\Carbon::parse($expiredAt)->format('d M Y') }}</p>
                                @else
                                    <p class="text-xs text-green-500">Berlaku s/d: Selamanya (Lifetime)</p>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Badge Status --}}
                        @php
                            $status = $plugin->order->status ?? 'pending';
                            $pluginData = $plugin->plugin_data ?? null;
                            $isActive = $pluginData && $pluginData->status === 'active';
                            
                            if (!$isActive && in_array($status, ['paid', 'active'])) {
                                $statusClass = 'bg-red-100 text-red-800 border-red-200';
                                $statusText = 'NONAKTIF';
                            } else {
                                $statusClass = match($status) {
                                    'paid', 'active' => 'bg-green-100 text-green-800 border-green-200',
                                    'pending' => 'bg-orange-100 text-orange-800 border-orange-200',
                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    default => 'bg-gray-100 text-gray-800 border-gray-200',
                                };
                                $statusText = $status === 'paid' ? 'AKTIF' : $status;
                            }
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x border-gray-100">
                        
                        <!-- License Info -->
                        <div class="p-6 lg:col-span-1 bg-white">
                            <div class="mb-4">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider text-[11px]">Status Langganan</h4>
                                <div class="flex items-center gap-2">
                                    <div class="text-lg font-bold text-gray-900">Rp {{ number_format($plugin->price, 0, ',', '.') }}</div>
                                    <span class="text-xs text-gray-500">/ {{ $plugin->billing_cycle }}</span>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider text-[11px]">Kode Lisensi</h4>
                                @if(in_array($status, ['paid', 'active']))
                                <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 relative group">
                                    <span class="font-mono text-blue-700 font-bold block">{{ $licenseKey }}</span>
                                    <button class="absolute top-1/2 -translate-y-1/2 right-3 text-blue-400 hover:text-blue-600 transition p-1 bg-white rounded shadow-sm border border-blue-100" onclick="copyToClipboard('{{ $licenseKey }}', 'Lisensi berhasil disalin!')" title="Copy License">
                                        <i class="ri-file-copy-line text-sm"></i>
                                    </button>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2">* Gunakan lisensi ini saat proses instalasi.</p>
                                @else
                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <span class="text-sm text-gray-500 font-medium">Menunggu Pembayaran</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Installation Steps -->
                        <div class="p-6 lg:col-span-2 bg-gray-50/30">
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="ri-terminal-box-line text-gray-400"></i> Panduan Instalasi via CLI
                            </h4>
                            
                            @if(in_array($status, ['paid', 'active']))
                            <div class="space-y-5">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-5 h-5 rounded bg-gray-800 text-white text-[10px] font-bold flex items-center justify-center">1</span>
                                        <h5 class="text-sm font-semibold text-gray-700">Jalankan Perintah Instalasi</h5>
                                    </div>
                                    <div class="bg-gray-900 text-gray-200 p-3.5 rounded-lg font-mono text-sm leading-relaxed shadow-inner">
                                        <p class="text-gray-500 text-xs mb-1"># Perintah Instalasi 1-Baris dengan NPX:</p>
                                        <div class="flex justify-between items-center group">
                                            <span>npx --package=futurecloud-{{ $cliCommand }}-cli@latest futurecloud-{{ $cliCommand }} install</span>
                                            <button class="text-gray-500 hover:text-white opacity-0 group-hover:opacity-100 transition" onclick="copyToClipboard('npx --package=futurecloud-{{ $cliCommand }}-cli@latest futurecloud-{{ $cliCommand }} install', 'Perintah berhasil disalin!')"><i class="ri-file-copy-line"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-5 h-5 rounded bg-gray-800 text-white text-[10px] font-bold flex items-center justify-center">2</span>
                                        <h5 class="text-sm font-semibold text-gray-700">Ikuti Prompt Konfigurasi</h5>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-7 leading-relaxed">
                                        Setelah menekan enter, CLI akan meminta beberapa input interaktif:
                                    </p>
                                    <ul class="list-disc list-inside text-sm text-gray-600 ml-8 mt-1 space-y-1">
                                        <li><strong>Lisensi:</strong> Ketikkan lisensi Anda (misal: FC-LIC-1234-ABCD12).</li>
                                        <li><strong>Framework:</strong> Ketikkan framework website Anda (Laravel, React, Vue, HTML).</li>
                                    </ul>
                                </div>
                                
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-5 h-5 rounded bg-gray-100 border border-gray-200 text-gray-600 text-[10px] font-bold flex items-center justify-center"><i class="ri-information-line"></i></span>
                                        <h5 class="text-sm font-semibold text-gray-700">Perintah Utilitas Lainnya</h5>
                                    </div>
                                    <div class="ml-7 bg-white border border-gray-200 p-3 rounded-lg font-mono text-xs text-gray-600 space-y-2">
                                        <p><span class="text-gray-400 inline-block w-20">Cek Versi:</span> futurecloud-{{ $cliCommand }} --version</p>
                                        <p><span class="text-gray-400 inline-block w-20">Bantuan:</span> futurecloud-{{ $cliCommand }} --help</p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="text-center p-8 bg-white border-2 border-dashed border-gray-200 rounded-xl">
                                <i class="ri-wallet-3-line text-4xl text-gray-300 mb-2 block"></i>
                                <h5 class="font-bold text-gray-700">Selesaikan Pembayaran</h5>
                                <p class="text-sm text-gray-500 mt-1">Panduan instalasi dan lisensi Anda akan muncul di sini setelah pembayaran berhasil diverifikasi.</p>
                                <a href="{{ route('client.invoices') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat Invoice Saya &rarr;</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function copyToClipboard(text, message = 'Berhasil disalin!') {
        navigator.clipboard.writeText(text).then(() => {
            const existingToast = document.getElementById('copy-toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.id = 'copy-toast';
            toast.className = 'fixed top-5 left-1/2 -translate-x-1/2 md:left-auto md:translate-x-0 md:right-5 bg-gray-900 text-white px-4 py-3 rounded-xl shadow-2xl flex items-center gap-3 z-[100] transform transition-all duration-300 -translate-y-10 opacity-0 border border-gray-700 w-[90%] md:w-auto max-w-sm';
            
            toast.innerHTML = `
                <div class="bg-green-500/20 text-green-400 rounded-full p-1 flex items-center justify-center shrink-0">
                    <i class="ri-check-line text-lg"></i>
                </div>
                <span class="text-sm font-medium tracking-wide">${message}</span>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('-translate-y-10', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('-translate-y-10', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
            customAlert('Gagal menyalin teks')
        });
    }
</script>

@endsection
