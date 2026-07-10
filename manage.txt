@extends('layouts.client-app')

@section('title', $title)

@section('content')

@php
    // AMBIL DATA DARI JSON CONFIGURATION
    $config = $service->configuration ?? [];
    
    // Default value jika data belum diset admin
    $ipAddress = $config['ip_address'] ?? 'Menunggu Alokasi';
    $username  = $config['username'] ?? '-';
    $password  = $config['password'] ?? '-';
    $domain    = $config['domain_connection'] ?? ($config['domain'] ?? $service->product_name);
    
    // Logic Datacenter Flag
    $dcCode = strtoupper($config['datacenter'] ?? 'US');
    $dcName = match($dcCode) {
        'ID' => 'Indonesia (Jakarta)',
        'SG' => 'Singapore',
        'US' => 'USA (North America)',
        'UK' => 'United Kingdom',
        'EU' => 'Europe (Netherlands)',
        default => 'Global'
    };
    $flagUrl = "https://flagcdn.com/w20/" . strtolower($dcCode == 'UK' ? 'gb' : $dcCode) . ".png";
@endphp

<div class="space-y-6">

    <!-- 1. HEADER & BREADCRUMBS -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Layanan</h2>
            <nav class="flex text-sm text-gray-500 mt-1">
                <a href="{{ route('client.dashboard') }}" class="hover:text-blue-600 transition">Client Area</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700 font-medium">#{{ $service->id }}</span>
            </nav>
        </div>
        
        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition shadow-sm">
            <i class="ri-arrow-left-line"></i> Kembali
        </a>
    </div>

    <!-- 2. STATUS BANNER & MAIN INFO -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI: DETAIL TEKNIS -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Informasi Utama -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">{{ $service->product_name }}</h3>
                    
                    {{-- Badge Status --}}
                    @php
                        $status = $service->order->status ?? 'pending';
                        $statusClass = match($status) {
                            'paid', 'active' => 'bg-green-100 text-green-800 border-green-200',
                            'pending' => 'bg-orange-100 text-orange-800 border-orange-200',
                            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                            default => 'bg-gray-100 text-gray-800 border-gray-200',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $statusClass }}">
                        {{ $status == 'paid' ? 'Active' : $status }}
                    </span>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        
                        <!-- Row: Registration Date -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                            <div class="text-sm font-semibold text-gray-500">Tanggal Daftar</div>
                            <div class="sm:col-span-2 text-sm text-gray-800 font-medium">
                                {{ $service->created_at->format('d M Y') }}
                            </div>
                        </div>

                        <!-- Row: Domain -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                Hosted Domain
                            </div>
                            <div class="sm:col-span-2 text-sm text-blue-600 font-medium">
                                <a href="http://{{ $domain }}" target="_blank" class="hover:underline">
                                    {{ $domain }}
                                </a>
                            </div>
                        </div>

                        <!-- Row: IP Address -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                IP Address
                            </div>
                            <div class="sm:col-span-2 text-sm font-mono text-gray-800 font-bold">
                                {{ $ipAddress }}
                            </div>
                        </div>

                        <!-- Row: Server Location (Dynamic Flag) -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                Server Location
                            </div>
                            <div class="sm:col-span-2 text-sm text-gray-800 flex items-center gap-2">
                                <img src="{{ $flagUrl }}" alt="{{ $dcCode }}" class="w-5 rounded-sm shadow-sm border border-gray-200">
                                <span>{{ $dcName }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Login Credentials Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showPass: false }">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Informasi Login (Credentials)</h3>
                </div>
                <div class="p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 text-orange-600">
                        <i class="ri-shield-keyh-line text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Username</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between group relative">
                                    <span id="usernameText">{{ $username }}</span>
                                    <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $username }}'); alert('Username disalin!')" title="Copy">
                                        <i class="ri-file-copy-line"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Password -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Password</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between items-center">
                                    <span x-show="!showPass" class="blur-sm select-none">••••••••••</span>
                                    <span x-show="showPass" class="text-gray-900 font-medium">{{ $password }}</span>
                                    
                                    <div class="flex gap-2">
                                        <button @click="showPass = !showPass" class="text-gray-400 hover:text-blue-600" title="Show/Hide">
                                            <i class="ri-eye-line" x-show="!showPass"></i>
                                            <i class="ri-eye-off-line" x-show="showPass"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $password }}'); alert('Password disalin!')" title="Copy">
                                            <i class="ri-file-copy-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">* Klik ikon mata untuk melihat password. Gunakan kredensial ini untuk login ke cPanel/SSH.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: ACTIONS & BILLING -->
        <div class="space-y-6">

            <!-- 1. Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                
                <div class="space-y-3">
                    @if($service->type == 'hosting')
                        <!-- Tombol Login cPanel -->
                        <a href="http://{{ $ipAddress }}:2083" target="_blank" 
                           class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 transform hover:-translate-y-0.5 transition">
                            <i class="ri-external-link-line text-lg"></i>
                            Login ke cPanel
                        </a>

                        <!-- Tombol Webmail -->
                        <a href="http://{{ $ipAddress }}:2096" target="_blank" 
                           class="w-full flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 font-semibold py-2.5 rounded-xl hover:bg-gray-50 transition">
                            <i class="ri-mail-send-line"></i>
                            Login Webmail
                        </a>
                    @elseif($service->type == 'vps')
                        <div class="p-3 bg-gray-900 text-gray-200 rounded-lg font-mono text-xs mb-3 break-all">
                            ssh {{ $username }}@ {{ $ipAddress }}
                        </div>
                    @endif
                </div>

                <hr class="my-4 border-gray-100">

                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('contact') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition group">
                        <i class="ri-lock-password-line text-xl text-gray-400 group-hover:text-blue-600 mb-1"></i>
                        <span class="text-xs font-medium">Reset Pass</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition group">
                        <i class="ri-hard-drive-2-line text-xl text-gray-400 group-hover:text-blue-600 mb-1"></i>
                        <span class="text-xs font-medium">Backup</span>
                    </a>
                </div>
            </div>

            <!-- 2. Billing Overview -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-4">Tagihan</h3>
                
                <div class="flex justify-between items-end mb-2">
                    <span class="text-gray-500 text-sm">Biaya Langganan</span>
                    <span class="text-xl font-bold text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                </div>
                <div class="text-right text-xs text-gray-500 mb-4 capitalize">
                    Per {{ $service->billing_cycle ?? 'Bulan' }}
                </div>

                <div class="bg-blue-50 rounded-lg p-3 flex items-start gap-3">
                    <i class="ri-calendar-check-line text-blue-600 mt-0.5"></i>
                    <div>
                        {{-- Logika tanggal jatuh tempo sederhana --}}
                        @php
                            $nextDue = $service->created_at->addYear(); // Default 1 tahun
                            if(str_contains(strtolower($service->billing_cycle), 'month')) $nextDue = $service->created_at->addMonth();
                        @endphp
                        <p class="text-xs text-blue-800 font-bold">Jatuh Tempo: {{ $nextDue->format('d M Y') }}</p>
                        <p class="text-[10px] text-blue-600 mt-0.5">Invoice akan dibuat 7 hari sebelumnya.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection