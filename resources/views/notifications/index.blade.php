@extends('layouts.landing')

@section('title', 'Semua Notifikasi')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
            <form action="{{ route('notifications.read') }}" method="POST">
                @csrf
                <button class="text-sm text-blue-600 hover:underline">Tandai semua dibaca</button>
            </form>
        </div>

        @if($groupedNotifications->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-200">
                <i class="ri-notification-off-line text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-gray-500">Belum ada notifikasi.</p>
            </div>
        @else
            <div class="space-y-8">
                @foreach($groupedNotifications as $date => $notifications)
                    {{-- GROUP TANGGAL --}}
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">
                                {{-- Format Tanggal: 03 Desember 2025 --}}
                                {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                            </h3>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden divide-y divide-gray-100">
                            @foreach($notifications as $notif)
                                <div class="p-5 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-gray-50 transition {{ $notif->read_at ? '' : 'bg-blue-50/40' }}">
                                    
                                    {{-- 1. Icon --}}
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-xl {{ $notif->data['color'] ?? 'text-blue-600' }}">
                                            <i class="{{ $notif->data['icon'] ?? 'ri-notification-line' }}"></i>
                                        </div>
                                    </div>

                                    {{-- 2. Konten Teks --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <p class="text-sm font-bold text-gray-900 truncate">
                                                {{ $notif->data['title'] ?? 'Pemberitahuan' }}
                                            </p>
                                            @if(!$notif->read_at)
                                                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            {{ $notif->data['message'] ?? '' }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-2 font-medium">
                                            <i class="ri-time-line align-middle"></i> 
                                            {{ $notif->created_at->format('H:i') }} WIB
                                        </p>
                                    </div>

                                    {{-- 3. Button Aksi (Kanan) --}}
                                    <div class="flex-shrink-0 mt-2 sm:mt-0">
                                        @if(isset($notif->data['link']))
                                            <a href="{{ $notif->data['link'] }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:text-blue-600 transition">
                                                Lihat Detail <i class="ri-arrow-right-line ml-2"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection