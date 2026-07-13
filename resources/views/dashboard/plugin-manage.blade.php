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
        <div class="space-y-8">
            @foreach($plugins as $plugin)
                @php
                    $config = $plugin->configuration ?? [];
                    if(is_string($config)) {
                        $config = json_decode($config, true) ?? [];
                    }
                    $licenseKey = $config['license_key'] ?? null;
                    
                    $isChatbot = str_contains(strtolower($plugin->product_name), 'chatbot');
                    $isInstalled = $plugin->plugin_data && $plugin->plugin_data->is_installed;
                @endphp

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ tab: '{{ $isChatbot ? 'settings' : 'dashboard' }}' }">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 {{ $isInstalled ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-400' }} rounded-lg flex items-center justify-center text-2xl">
                                <i class="ri-plug-line"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $plugin->product_name }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($isInstalled)
                                        <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                            <i class="ri-check-line mr-1"></i> Terinstal
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                            <i class="ri-error-warning-line mr-1"></i> Belum Terinstal
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$isInstalled)
                        <div class="p-8 text-center bg-white">
                            <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ri-terminal-box-line text-3xl text-yellow-500"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Plugin Belum Diinstal</h3>
                            <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">Plugin ini belum terdeteksi di website Anda. Silakan ikuti panduan instalasi di halaman Plugin Saya.</p>
                            <a href="{{ route('client.plugin') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                                <i class="ri-file-list-3-line"></i> Lihat Panduan Instalasi
                            </a>
                        </div>
                    @else
                        <!-- TABS HEADER -->
                        <div class="flex border-b border-gray-100 px-6 bg-white overflow-x-auto">
                            @if($isChatbot)
                                <button @click="tab = 'settings'" class="px-4 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'settings' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                                    <i class="ri-settings-3-line mr-1.5"></i> Pengaturan Bot
                                </button>
                                <button @click="tab = 'chatbot'" class="px-4 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'chatbot' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                                    <i class="ri-robot-line mr-1.5"></i> Manajemen Chatbot
                                </button>
                                <button @click="tab = 'livechat'" class="px-4 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'livechat' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                                    <i class="ri-customer-service-2-line mr-1.5"></i> Live Chat
                                </button>
                            @else
                                <button @click="tab = 'dashboard'" class="px-4 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'dashboard' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                                    <i class="ri-dashboard-line mr-1.5"></i> Dashboard Analytics
                                </button>
                            @endif
                        </div>

                        <!-- TABS CONTENT -->
                        <div class="p-0 bg-white">
                            @if($isChatbot)
                                <!-- SETTINGS TAB -->
                                <div x-show="tab === 'settings'" class="p-6">
                                    <form action="{{ route('plugin.chatbot.update', $plugin->id) }}" method="POST" class="max-w-2xl">
                                        @csrf
                                        @method('PUT')
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bot</label>
                                                <input type="text" name="bot_name" value="{{ $plugin->plugin_data->bot_name ?? 'Chatbot Ai' }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" required>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Warna Tema (HEX)</label>
                                                <div class="flex items-center gap-3">
                                                    <input type="color" name="bot_color" value="{{ $plugin->plugin_data->bot_color ?? '#2563eb' }}" class="w-10 h-10 rounded cursor-pointer border-0 p-0" required>
                                                    <input type="text" name="bot_color_text" value="{{ $plugin->plugin_data->bot_color ?? '#2563eb' }}" class="flex-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" oninput="this.previousElementSibling.value = this.value" required>
                                                </div>
                                            </div>
                                            <div class="pt-2">
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                                                    Simpan Pengaturan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- IFRAME TABS -->
                                <div x-show="tab === 'chatbot'" style="display: none; height: 800px;">
                                    <iframe src="https://api-chatbot.futurecloud.id/embed/chatbot?license={{ $licenseKey }}" width="100%" height="100%" style="border:none;"></iframe>
                                </div>
                                <div x-show="tab === 'livechat'" style="display: none; height: 800px;">
                                    <iframe src="https://api-chatbot.futurecloud.id/embed/livechat?license={{ $licenseKey }}" width="100%" height="100%" style="border:none;"></iframe>
                                </div>
                            @else
                                <!-- MONITORING TAB -->
                                <div x-show="tab === 'dashboard'" style="height: 800px;">
                                    <iframe src="https://api-monitoring.futurecloud.id/embed/dashboard?license={{ $licenseKey }}" width="100%" height="100%" style="border:none;"></iframe>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
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
