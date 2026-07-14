@extends('layouts.client-app')

@section('title', 'Kelola Plugin')

@section('content')

<div class="space-y-6">
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Plugin</h2>
            <p class="text-sm text-gray-500 mt-1">Konfigurasi dan pantau plugin Anda yang sudah terinstal.</p>
        </div>
    </div>

    @if($plugins->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-settings-4-line text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada plugin</h3>
            <p class="text-gray-500 text-sm mb-4">Anda belum memiliki produk plugin yang aktif.</p>
            <a href="{{ route('saas.detail') }}" class="btn-action inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                <i class="ri-shopping-bag-line"></i> Beli Plugin
            </a>
        </div>
    @else
        <div class="flex flex-col gap-6" x-data="{ activePlugin: {{ $plugins->first()->id }} }">
            <!-- Top Horizontal Tab Menu -->
            <div class="w-full">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2 pt-1 pb-2">Daftar Plugin</h3>
                    <div class="flex overflow-x-auto gap-3 pb-2 snap-x">
                    @foreach($plugins as $plugin)
                        @php
                            $config = $plugin->configuration ?? [];
                            if(is_string($config)) {
                                $config = json_decode($config, true) ?? [];
                            }
                            $licenseKey = $config['license_key'] ?? null;
                            $pluginData = $plugin->plugin_data ?? null;
                            $isInstalled = $pluginData && $pluginData->is_installed;
                            $isActive = $pluginData && $pluginData->status === 'active';
                        @endphp
                        <button @click="activePlugin = {{ $plugin->id }}"
                            :class="activePlugin === {{ $plugin->id }} ? 'bg-blue-50 border-blue-200 shadow-sm' : 'hover:bg-gray-50 border-gray-100'"
                            class="min-w-[340px] text-left px-4 py-3 rounded-lg border flex items-center gap-3 transition-all duration-200 snap-start shrink-0 relative">
                            
                            <div class="w-10 h-10 rounded flex items-center justify-center text-xl shrink-0 transition-colors"
                                :class="activePlugin === {{ $plugin->id }} ? 'bg-white text-blue-600 shadow-sm border border-blue-100' : 'bg-gray-50 text-gray-400'">
                                <i class="{{ str_contains(strtolower($plugin->product_name), 'chatbot') ? 'ri-robot-2-fill' : 'ri-bar-chart-grouped-fill' }}"></i>
                            </div>
                            
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-bold truncate" :class="activePlugin === {{ $plugin->id }} ? 'text-blue-800' : 'text-gray-800'">
                                    {{ $plugin->product_name }}
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    @if(!$isActive)
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-medium bg-red-100 text-red-700 border border-red-200 whitespace-nowrap">
                                            <i class="ri-close-circle-line mr-0.5"></i> Dinonaktifkan
                                        </span>
                                    @elseif($isInstalled)
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-medium bg-green-100 text-green-700 border border-green-200 whitespace-nowrap">
                                            <i class="ri-check-line mr-0.5"></i> Terinstal
                                        </span>
                                    @else
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600 border border-gray-200 whitespace-nowrap">
                                            <i class="ri-error-warning-line mr-0.5"></i> Belum Terinstal
                                        </span>
                                    @endif
                                    
                                    <span class="text-[10px] text-gray-400 font-mono border-l border-gray-200 pl-2 whitespace-nowrap">
                                        {{ $licenseKey ?? 'Tanpa Lisensi' }}
                                    </span>
                                </div>
                            </div>
                        </button>
                    @endforeach
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="w-full">
                @foreach($plugins as $plugin)
                    @php
                        $config = $plugin->configuration ?? [];
                        if(is_string($config)) {
                            $config = json_decode($config, true) ?? [];
                        }
                        $licenseKey = $config['license_key'] ?? null;
                        
                        $isChatbot = str_contains(strtolower($plugin->product_name), 'chatbot');
                        $pluginData = $plugin->plugin_data ?? null;
                        $isInstalled = $pluginData && $pluginData->is_installed;
                        $isActive = $pluginData && $pluginData->status === 'active';
                    @endphp

                    <div x-show="activePlugin === {{ $plugin->id }}" x-transition.opacity.duration.300ms style="display: none;">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ tab: '{{ $isChatbot ? 'settings' : 'dashboard' }}' }">


                            @if(!$isActive)
                                <div class="p-10 text-center bg-white">
                                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5 border border-red-100">
                                        <i class="ri-error-warning-fill text-4xl text-red-500"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Lisensi Dinonaktifkan</h3>
                                    <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">Lisensi plugin Anda telah dinonaktifkan oleh administrator. Fungsionalitas plugin dihentikan, silakan hubungi tim dukungan kami untuk bantuan.</p>
                                </div>
                            @elseif(!$isInstalled)
                                <div class="p-10 text-center bg-white">
                                    <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-5 border border-yellow-100">
                                        <i class="ri-terminal-box-line text-4xl text-yellow-500"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Instalasi Diperlukan</h3>
                                    <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">Plugin ini belum terdeteksi aktif di website Anda. Instal plugin ini ke dalam source code website Anda melalui terminal.</p>
                                    <a href="{{ route('client.plugin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm hover:shadow">
                                        <i class="ri-file-list-3-line"></i> Lihat Panduan Instalasi
                                    </a>
                                </div>
                            @else
                                <!-- TABS HEADER -->
                                <div class="flex justify-between items-center border-b border-gray-100 px-6 bg-white overflow-x-auto">
                                    <div class="flex">
                                        @if($isChatbot)
                                            <button @click="tab = 'settings'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'settings' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-settings-3-line mr-1.5"></i> Pengaturan Bot
                                            </button>
                                            <button @click="tab = 'chatbot'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'chatbot' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-robot-line mr-1.5"></i> Manajemen Pengetahuan
                                            </button>
                                            <button @click="tab = 'livechat'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'livechat' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-customer-service-2-line mr-1.5"></i> Live Chat
                                            </button>
                                        @else
                                            <button @click="tab = 'dashboard'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'dashboard' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-dashboard-line mr-1.5"></i> Dashboard Analytics
                                            </button>
                                        @endif
                                    </div>
                                    
                                    <div class="shrink-0 ml-4 py-2">
                                        <form action="{{ route('client.plugin.reset', $plugin->id) }}" method="POST" onsubmit="return confirm('Peringatan: Aksi ini akan menghapus semua data (Analitik/Leads) secara permanen. Apakah Anda yakin ingin mereset data?');">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded text-xs font-semibold flex items-center gap-1 transition">
                                                <i class="ri-delete-bin-line"></i> Reset Data
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- TABS CONTENT -->
                                <div class="p-0 bg-white">
                                    @if($isChatbot)
                                        <!-- SETTINGS TAB -->
                                        <div x-show="tab === 'settings'" class="p-8">
                                            <form action="{{ route('client.plugin.chatbot.update', $plugin->id) }}" method="POST" class="max-w-2xl bg-gray-50 p-6 rounded-xl border border-gray-100">
                                                @csrf
                                                @method('PUT')
                                                <h4 class="text-lg font-bold text-gray-800 mb-4">Penyesuaian Widget</h4>
                                                <div class="space-y-5">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Bot / Header Widget</label>
                                                        <input type="text" name="bot_name" value="{{ $plugin->plugin_data->bot_name ?? 'Chatbot Ai' }}" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" required placeholder="Contoh: CS FutureCloud">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Warna Tema Widget</label>
                                                        <div class="flex items-center gap-3">
                                                            <div class="relative w-12 h-12 rounded-lg overflow-hidden border border-gray-200 shadow-sm shrink-0 cursor-pointer">
                                                                <input type="color" name="bot_color" value="{{ $plugin->plugin_data->bot_color ?? '#2563eb' }}" class="absolute -top-2 -left-2 w-16 h-16 cursor-pointer border-0 p-0" required>
                                                            </div>
                                                            <input type="text" name="bot_color_text" value="{{ $plugin->plugin_data->bot_color ?? '#2563eb' }}" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition uppercase font-mono text-sm" oninput="this.previousElementSibling.firstElementChild.value = this.value" required>
                                                        </div>
                                                        <p class="text-xs text-gray-500 mt-2">Pilih warna yang sesuai dengan brand website Anda.</p>
                                                    </div>
                                                    <div class="pt-4 border-t border-gray-200">
                                                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm hover:shadow w-full sm:w-auto">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!-- IFRAME TABS -->
                                        <div x-show="tab === 'chatbot'" style="display: none; height: 800px;" class="bg-gray-50 p-2">
                                            <iframe src="https://api-chatbot.futurecloud.id/embed/chatbot?license={{ $licenseKey }}" width="100%" height="100%" class="rounded-lg shadow-sm border border-gray-200 bg-white"></iframe>
                                        </div>
                                        <div x-show="tab === 'livechat'" style="display: none; height: 800px;" class="bg-gray-50 p-2">
                                            <iframe src="https://api-chatbot.futurecloud.id/embed/livechat?license={{ $licenseKey }}" width="100%" height="100%" class="rounded-lg shadow-sm border border-gray-200 bg-white"></iframe>
                                        </div>
                                    @else
                                        <!-- MONITORING TAB -->
                                        <div x-show="tab === 'dashboard'" style="height: 800px;" class="bg-gray-50 p-2">
                                            <iframe src="https://api-monitoring.futurecloud.id/embed/dashboard?license={{ $licenseKey }}" width="100%" height="100%" class="rounded-lg shadow-sm border border-gray-200 bg-white"></iframe>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    // Sync color inputs
    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('input', function() {
            this.nextElementSibling.value = this.value;
        });
    });
</script>

@endsection
