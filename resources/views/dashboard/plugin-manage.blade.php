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
                        $integrationType = $config['integration_type'] ?? 'mysql';
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
                                            <button @click="tab = 'helpdesk'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'helpdesk' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-user-add-line mr-1.5"></i> Helpdesk Users
                                            </button>
                                            <button @click="tab = 'database'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'database' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-database-2-line mr-1.5"></i> Integrasi Database
                                            </button>
                                        @else
                                            <button @click="tab = 'dashboard'" class="px-5 py-3.5 text-sm font-medium border-b-2 whitespace-nowrap transition-colors" :class="tab === 'dashboard' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                                                <i class="ri-dashboard-line mr-1.5"></i> Dashboard Analytics
                                            </button>
                                        @endif
                                    </div>
                                    
                                    <div class="shrink-0 ml-4 py-2">
                                        <form action="{{ route('client.plugin.reset', $plugin->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Peringatan: Aksi ini akan menghapus semua data (Analitik/Leads) secara permanen. Apakah Anda yakin ingin mereset data?')">
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
                                                
                                                <!-- Hidden fields to preserve Database settings -->
                                                <input type="hidden" name="integration_type" value="{{ $integrationType }}">
                                                <input type="hidden" name="db_allow_read" value="{{ $config['db_allow_read'] ?? 0 }}">
                                                <input type="hidden" name="db_host" value="{{ $config['db_host'] ?? '' }}">
                                                <input type="hidden" name="db_port" value="{{ $config['db_port'] ?? '' }}">
                                                <input type="hidden" name="db_database" value="{{ $config['db_database'] ?? '' }}">
                                                <input type="hidden" name="db_username" value="{{ $config['db_username'] ?? '' }}">
                                                <input type="hidden" name="db_password" value="{{ $config['db_password'] ?? '' }}">
                                                <input type="hidden" name="spreadsheet_id" value="{{ $config['spreadsheet_id'] ?? '' }}">
                                                <input type="hidden" name="sheet_name_range" value="{{ $config['sheet_name_range'] ?? '' }}">
                                                
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
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor WhatsApp (Opsional)</label>
                                                        <input type="text" name="whatsapp_number" value="{{ $plugin->configuration['whatsapp_number'] ?? '' }}" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="Contoh: 628123456789">
                                                        <p class="text-xs text-gray-500 mt-2">Isi jika Anda ingin menampilkan tombol WhatsApp pada Chatbot. Kosongkan jika tidak ingin menampilkan tombol WhatsApp.</p>
                                                    </div>

                                                    {{-- WhatsApp Bot Integration --}}
                                                    <div class="border border-green-200 bg-green-50/50 rounded-xl p-5" x-data="whatsappConnect('{{ $licenseKey }}')" x-init="checkStatus()">
                                                        <div class="flex items-center gap-3 mb-3">
                                                            <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center">
                                                                <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                                            </div>
                                                            <div>
                                                                <h5 class="text-sm font-bold text-gray-800">WhatsApp Bot AI</h5>
                                                                <p class="text-xs text-gray-500">Hubungkan WhatsApp agar bot AI membalas pesan otomatis</p>
                                                            </div>
                                                        </div>

                                                        {{-- Status: Not Connected --}}
                                                        <template x-if="status === 'not_started' || status === 'disconnected'">
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-3 px-3 py-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                                                    <span class="text-xs font-medium text-yellow-700">Belum Terhubung</span>
                                                                </div>
                                                                <button type="button" @click="connect()" :disabled="loading" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 transition shadow-sm disabled:opacity-50 flex items-center justify-center gap-2">
                                                                    <template x-if="loading">
                                                                        <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                                                    </template>
                                                                    <template x-if="!loading">
                                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                                                    </template>
                                                                    <span x-text="loading ? 'Menghubungkan...' : 'Hubungkan WhatsApp'"></span>
                                                                </button>
                                                            </div>
                                                        </template>

                                                        {{-- Status: QR Code --}}
                                                        <template x-if="status === 'qr'">
                                                            <div class="text-center">
                                                                <div class="bg-white rounded-xl p-4 border border-gray-200 inline-block mb-3">
                                                                    <img :src="qrDataUrl" alt="WhatsApp QR Code" class="w-64 h-64 mx-auto">
                                                                </div>
                                                                <p class="text-sm text-gray-600 font-medium mb-1">Scan QR Code ini dengan WhatsApp Anda</p>
                                                                <p class="text-xs text-gray-400">Buka WhatsApp → Menu → Perangkat Tertaut → Tautkan Perangkat</p>
                                                            </div>
                                                        </template>

                                                        {{-- Status: Initializing --}}
                                                        <template x-if="status === 'initializing'">
                                                            <div class="flex items-center gap-3 px-3 py-3 bg-blue-50 border border-blue-200 rounded-lg">
                                                                <svg class="animate-spin w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                                                <span class="text-sm font-medium text-blue-700">Menyiapkan sesi WhatsApp...</span>
                                                            </div>
                                                        </template>

                                                        {{-- Status: Connected --}}
                                                        <template x-if="status === 'ready'">
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-3 px-3 py-2 bg-green-100 border border-green-300 rounded-lg">
                                                                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                                                    <span class="text-xs font-bold text-green-700">Terhubung</span>
                                                                    <span class="text-xs text-green-600" x-show="connectedPhone" x-text="'(' + connectedPhone + ')'"></span>
                                                                </div>
                                                                <p class="text-xs text-gray-500 mb-3">Bot AI sekarang aktif di WhatsApp Anda. Semua pesan masuk akan dibalas otomatis oleh AI berdasarkan Knowledge yang sudah ditambahkan.</p>
                                                                <button type="button" @click="disconnect()" :disabled="loading" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition border border-red-200 disabled:opacity-50">
                                                                    <span x-text="loading ? 'Memutuskan...' : 'Putuskan Koneksi'"></span>
                                                                </button>
                                                            </div>
                                                        </template>

                                                        {{-- Error --}}
                                                        <template x-if="status === 'error'">
                                                            <div>
                                                                <div class="flex items-center gap-2 mb-3 px-3 py-2 bg-red-50 border border-red-200 rounded-lg">
                                                                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                                                    <span class="text-xs font-medium text-red-700">Terjadi Kesalahan</span>
                                                                </div>
                                                                <p class="text-xs text-red-500 mb-2" x-text="errorMsg"></p>
                                                                <button type="button" @click="connect()" class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs font-semibold hover:bg-green-700 transition">
                                                                    Coba Lagi
                                                                </button>
                                                            </div>
                                                        </template>
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
                                        <div x-show="tab === 'helpdesk'" style="display: none;" class="p-6">
                                            @include('dashboard.partials.helpdesk-manage', ['licenseKey' => $licenseKey])
                                        </div>
                                        
                                        <!-- DATABASE INTEGRATION TAB -->
                                        <div x-show="tab === 'database'" style="display: none;" class="p-8">
                                            <form action="{{ route('client.plugin.chatbot.update', $plugin->id) }}" method="POST" class="max-w-2xl bg-gray-50 p-6 rounded-xl border border-gray-100" x-data="{ integrationType: '{{ $integrationType }}' }">
                                                @csrf
                                                @method('PUT')
                                                <!-- Hidden fields for other settings so they don't get erased -->
                                                <input type="hidden" name="bot_name" value="{{ $plugin->plugin_data->bot_name ?? 'Chatbot Ai' }}">
                                                <input type="hidden" name="bot_color" value="{{ $plugin->plugin_data->bot_color ?? '#2563eb' }}">
                                                <input type="hidden" name="whatsapp_number" value="{{ $plugin->plugin_data->whatsapp_number ?? '' }}">
                                                
                                                <h4 class="text-lg font-bold text-gray-800 mb-4">Integrasi Database Klien</h4>
                                                <p class="text-sm text-gray-600 mb-6">Hubungkan database proyek Anda agar AI dapat membaca dan menjawab pertanyaan berdasarkan data real-time bisnis Anda.</p>
                                                
                                                <div class="mb-5 bg-blue-50 border border-blue-100 p-4 rounded-lg">
                                                    <label class="flex items-center space-x-3 cursor-pointer">
                                                        <input type="checkbox" name="db_allow_read" value="1" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300" {{ (isset($config['db_allow_read']) && $config['db_allow_read']) ? 'checked' : '' }}>
                                                        <span class="text-gray-800 font-bold">Izinkan Chatbot AI membaca Database ini</span>
                                                    </label>
                                                </div>

                                                <!-- Pilihan Tipe Integrasi -->
                                                <div class="mb-5">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipe Integrasi</label>
                                                    <select name="integration_type" x-model="integrationType" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition">
                                                        <option value="mysql">MySQL / PostgreSQL Database</option>
                                                        <option value="google_sheet">Google Sheet</option>
                                                    </select>
                                                </div>

                                                <!-- Form Khusus MySQL -->
                                                <div x-show="integrationType === 'mysql'" class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5" style="display: none;">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Database Host</label>
                                                        <input type="text" name="db_host" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="127.0.0.1" value="{{ $config['db_host'] ?? '127.0.0.1' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Port</label>
                                                        <input type="text" name="db_port" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="3306" value="{{ $config['db_port'] ?? '3306' }}">
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Database</label>
                                                        <input type="text" name="db_database" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="nama_db" value="{{ $config['db_database'] ?? '' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Username Database</label>
                                                        <input type="text" name="db_username" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="root" value="{{ $config['db_username'] ?? '' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Database</label>
                                                        <input type="password" name="db_password" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="***" value="{{ $config['db_password'] ?? '' }}">
                                                    </div>

                                                    <!-- Table Selection (If DB Connected) -->
                                                    <div class="md:col-span-2">
                                                        @if(!empty($config['db_host']) && !empty($config['db_database']))
                                                            <div class="mt-4 border-t border-gray-200 pt-5">
                                                                @if($plugin->db_connection_error)
                                                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded">
                                                                        <div class="flex">
                                                                            <div class="flex-shrink-0">
                                                                                <i class="ri-error-warning-line text-red-500"></i>
                                                                            </div>
                                                                            <div class="ml-3">
                                                                                <p class="text-sm text-red-700 font-bold">Gagal terhubung ke database!</p>
                                                                                <p class="text-xs text-red-600 mt-1">{{ $plugin->db_connection_error }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif(!empty($plugin->available_tables))
                                                                    <h5 class="text-md font-bold text-gray-800 mb-2">Pilih Tabel yang Boleh Dibaca AI <span class="text-xs text-gray-500 font-normal ml-2">({{ count($plugin->available_tables) }} tabel ditemukan)</span></h5>
                                                                    <p class="text-xs text-gray-500 mb-4">Centang tabel yang berisi informasi produk, harga, faq, atau data lain yang relevan agar AI dapat menjawab berdasarkan data tersebut. Jangan centang tabel sensitif seperti users/passwords.</p>
                                                                    
                                                                    @php
                                                                        $allowedTables = $config['db_allowed_tables'] ?? [];
                                                                    @endphp
                                                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-4 bg-white border border-gray-200 rounded-lg shadow-inner">
                                                                        @foreach($plugin->available_tables as $table)
                                                                            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-1.5 rounded transition">
                                                                                <input type="checkbox" name="db_allowed_tables[]" value="{{ $table }}" 
                                                                                    class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300"
                                                                                    {{ in_array($table, $allowedTables) ? 'checked' : '' }}>
                                                                                <span class="text-sm text-gray-700 truncate" title="{{ $table }}">{{ $table }}</span>
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4 rounded">
                                                                        <p class="text-sm text-yellow-700">Koneksi berhasil, tetapi tidak ditemukan tabel di dalam database tersebut.</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Form Khusus Google Sheet -->
                                                <div x-show="integrationType === 'google_sheet'" class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5" style="display: none;">
                                                    <div class="md:col-span-2">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Spreadsheet ID</label>
                                                        <input type="text" name="spreadsheet_id" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="Contoh: 1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms" value="{{ $config['spreadsheet_id'] ?? '' }}">
                                                        <p class="text-xs text-gray-500 mt-2">Ambil dari URL Sheet Anda. Jangan lupa <b>Share</b> sheet Anda ke email AI kami: <strong class="text-blue-600 select-all">futurecloud-chatbot-sheet@futurecloud-chatbot-sheet.iam.gserviceaccount.com</strong> dengan akses <b>Viewer</b>.</p>
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Sheet Name & Range (Opsional)</label>
                                                        <input type="text" name="sheet_name_range" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition" placeholder="Contoh: DataProduk!A1:E1000" value="{{ $config['sheet_name_range'] ?? '' }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-6 pt-5 border-t border-gray-200 flex justify-end">
                                                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                                        <i class="ri-save-line mr-1"></i> Simpan Konfigurasi
                                                    </button>
                                                </div>
                                            </form>
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

    // WhatsApp Connect Alpine Component
    function whatsappConnect(licenseKey) {
        return {
            licenseKey: licenseKey,
            status: 'not_started',
            qrDataUrl: null,
            connectedPhone: null,
            connectedName: null,
            loading: false,
            errorMsg: '',
            pollInterval: null,
            apiBase: 'https://api-chatbot.futurecloud.id/api/whatsapp',

            async checkStatus() {
                try {
                    const res = await fetch(`${this.apiBase}/session-status?license=${this.licenseKey}`);
                    const data = await res.json();
                    this.handleStatusResponse(data);
                } catch (e) {
                    console.log('WA status check failed:', e);
                }
            },

            handleStatusResponse(data) {
                if (data.status) {
                    this.status = data.status;
                }
                if (data.qrDataUrl) {
                    this.qrDataUrl = data.qrDataUrl;
                }
                if (data.info && data.info.phone) {
                    this.connectedPhone = data.info.phone;
                    this.connectedName = data.info.name;
                }
                // Fallback to DB status
                if (data.db_connected && this.status !== 'ready') {
                    this.status = 'ready';
                    this.connectedPhone = data.db_phone;
                    this.connectedName = data.db_name;
                }
            },

            async connect() {
                this.loading = true;
                this.errorMsg = '';
                this.status = 'initializing';

                try {
                    const res = await fetch(`${this.apiBase}/connect`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-FutureCloud-License': this.licenseKey
                        },
                        body: JSON.stringify({ license: this.licenseKey })
                    });
                    const data = await res.json();

                    if (data.error) {
                        this.status = 'error';
                        this.errorMsg = data.error;
                        this.loading = false;
                        return;
                    }

                    this.handleStatusResponse(data);
                    this.loading = false;

                    // Start polling for status updates (QR -> ready)
                    this.startPolling();
                } catch (e) {
                    this.status = 'error';
                    this.errorMsg = 'Gagal menghubungi server WhatsApp. Pastikan service sudah berjalan.';
                    this.loading = false;
                }
            },

            startPolling() {
                this.stopPolling();
                this.pollInterval = setInterval(async () => {
                    try {
                        const res = await fetch(`${this.apiBase}/session-status?license=${this.licenseKey}`);
                        const data = await res.json();
                        this.handleStatusResponse(data);

                        // Stop polling when connected or error
                        if (data.status === 'ready' || data.status === 'error' || data.status === 'disconnected') {
                            this.stopPolling();
                        }
                    } catch (e) {
                        console.log('Poll error:', e);
                    }
                }, 3000);
            },

            stopPolling() {
                if (this.pollInterval) {
                    clearInterval(this.pollInterval);
                    this.pollInterval = null;
                }
            },

            async disconnect() {
                let confirmed = false;
                if (typeof Swal !== 'undefined') {
                    const result = await Swal.fire({
                        title: 'Putuskan Koneksi?',
                        text: 'Jika diputuskan, Anda harus men-scan ulang QR Code jika ingin menghubungkannya kembali.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Putuskan!',
                        cancelButtonText: 'Batal'
                    });
                    confirmed = result.isConfirmed;
                } else {
                    confirmed = confirm('Apakah Anda yakin ingin memutuskan koneksi WhatsApp Bot? Anda harus men-scan ulang QR Code jika ingin menghubungkannya kembali.');
                }
                
                if (!confirmed) return;
                
                this.loading = true;

                try {
                    await fetch(`${this.apiBase}/disconnect`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-FutureCloud-License': this.licenseKey
                        },
                        body: JSON.stringify({ license: this.licenseKey })
                    });
                    this.status = 'not_started';
                    this.qrDataUrl = null;
                    this.connectedPhone = null;
                    this.connectedName = null;
                } catch (e) {
                    console.error('Disconnect error:', e);
                }
                this.loading = false;
            }
        };
    }
</script>

@endsection