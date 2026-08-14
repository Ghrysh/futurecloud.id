@extends('layouts.landing')

@section('title', 'Semua Notifikasi')

@section('content')
<main class="min-h-screen bg-slate-50 pt-28 pb-24 relative overflow-hidden font-['Inter']">
    {{-- Dekorasi Latar --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-100 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-100 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4 scroll-reveal">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Notifikasi</h1>
                <p class="text-slate-500 mt-2 font-medium">Semua pemberitahuan dan aktivitas akun Anda.</p>
            </div>
            
            <form action="{{ route('notifications.read') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                    <i class="ri-check-double-line text-lg"></i> Tandai semua dibaca
                </button>
            </form>
        </div>

        @if($groupedNotifications->isEmpty())
            <div class="text-center py-24 bg-white/60 backdrop-blur-md rounded-3xl border border-slate-200 shadow-sm scroll-reveal">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-100 text-slate-300 mb-6 border-8 border-white shadow-sm">
                    <i class="ri-notification-off-line text-4xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-700 mb-2">Belum ada notifikasi</h3>
                <p class="text-slate-500 font-medium">Saat ini tidak ada pemberitahuan baru untuk Anda.</p>
            </div>
        @else
            <div class="space-y-12">
                @foreach($groupedNotifications as $index => $group)
                    @php 
                        $date = $index;
                        $notifications = $group; 
                    @endphp
                    {{-- GROUP TANGGAL --}}
                    <div class="scroll-reveal" style="transition-delay: {{ $loop->index * 100 }}ms;">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="px-4 py-1.5 bg-white border border-slate-200 rounded-full shadow-sm">
                                <h3 class="text-xs font-bold text-slate-600 tracking-wider">
                                    {{-- Format Tanggal: 03 Desember 2025 --}}
                                    @if(\Carbon\Carbon::parse($date)->isToday())
                                        Hari Ini
                                    @elseif(\Carbon\Carbon::parse($date)->isYesterday())
                                        Kemarin
                                    @else
                                        {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                                    @endif
                                </h3>
                            </div>
                            <div class="h-px bg-slate-200 flex-1"></div>
                        </div>

                        <div class="space-y-4">
                            @foreach($notifications as $notif)
                                @php
                                    $isUnread = is_null($notif->read_at);
                                    $bgColorClass = $notif->data['bg_color'] ?? 'bg-blue-50';
                                    $textColorClass = $notif->data['color'] ?? 'text-blue-600';
                                @endphp

                                <div class="group bg-white/80 backdrop-blur-md rounded-2xl border transition-all duration-300 {{ $isUnread ? 'border-blue-200 shadow-md shadow-blue-900/5' : 'border-slate-200 shadow-sm hover:border-slate-300 hover:shadow-md' }} overflow-hidden">
                                    <div class="p-6 flex flex-col sm:flex-row sm:items-start gap-5 relative">
                                        
                                        @if($isUnread)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-l-2xl"></div>
                                        @endif

                                        {{-- 1. Icon --}}
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-2xl {{ $bgColorClass }} flex items-center justify-center text-2xl {{ $textColorClass }} border border-white shadow-inner">
                                                <i class="{{ $notif->data['icon'] ?? 'ri-notification-4-fill' }}"></i>
                                            </div>
                                        </div>

                                        {{-- 2. Konten Teks --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-4 mb-1.5">
                                                <div class="flex items-center gap-2">
                                                    <h4 class="text-base font-bold {{ $isUnread ? 'text-slate-900' : 'text-slate-700' }} truncate">
                                                        {{ $notif->data['title'] ?? 'Pemberitahuan' }}
                                                    </h4>
                                                    @if($isUnread)
                                                        <span class="px-2 py-0.5 bg-red-100 text-red-600 text-[10px] font-black rounded-full uppercase tracking-wider">Baru</span>
                                                    @endif
                                                </div>
                                                <span class="text-xs font-medium text-slate-400 whitespace-nowrap shrink-0 flex items-center gap-1">
                                                    <i class="ri-time-line"></i> {{ $notif->created_at->format('H:i') }}
                                                </span>
                                            </div>
                                            
                                            <p class="text-sm {{ $isUnread ? 'text-slate-700' : 'text-slate-500' }} leading-relaxed font-medium">
                                                {{ $notif->data['message'] ?? '' }}
                                            </p>

                                            {{-- 3. Button Aksi (Bawah pada mobile, Kanan pada desktop) --}}
                                            @if(isset($notif->data['link']))
                                                <div class="mt-4 pt-4 border-t border-slate-100">
                                                    <a href="{{ $notif->data['link'] }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-50 border border-slate-200 shadow-sm text-sm font-bold rounded-xl text-slate-700 hover:bg-blue-600 hover:border-blue-600 hover:text-white transition-all group-hover:-translate-y-0.5">
                                                        Lihat Detail <i class="ri-arrow-right-up-line"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</main>
@endsection
