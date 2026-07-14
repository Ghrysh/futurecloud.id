@extends('layouts.admin-app')

@section('title', 'Admin Approval SaaS')
@section('header_title', 'Persetujuan Aplikasi SaaS')

@section('content')
    <div class="space-y-6">

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl border border-green-100 flex items-center gap-3 animate-fade-in-down">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center shrink-0 text-green-600">
                    <i class="ri-checkbox-circle-fill text-lg"></i>
                </div>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                    <i class="ri-time-line text-yellow-500"></i> Daftar Permintaan Pending
                </h3>
                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200 w-fit">
                    {{ $pendingApps->count() }} Menunggu
                </span>
            </div>

            {{-- 1. TAMPILAN DESKTOP (TABLE) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 border-b border-gray-100 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4">Nama Aplikasi</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Partner</th>
                            <th class="px-6 py-4">Tanggal Request</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendingApps as $app)
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $app->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                    {{ $app->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-[10px] font-bold">
                                        {{ substr($app->user->name, 0, 1) }}
                                    </div>
                                    {{ $app->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs font-mono">
                                {{ $app->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    {{-- Approve --}}
                                    <form action="{{ route('admin.saas.approve', $app->id) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-600 text-white w-8 h-8 rounded-lg hover:bg-green-700 transition shadow-sm flex items-center justify-center" title="Approve">
                                            <i class="ri-check-line text-lg"></i>
                                        </button>
                                    </form>
                                    {{-- Reject --}}
                                    <form action="{{ route('admin.saas.reject', $app->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Yakin ingin menolak aplikasi ini?')">
                                        @csrf
                                        <button class="bg-white border border-red-200 text-red-500 w-8 h-8 rounded-lg hover:bg-red-50 transition shadow-sm flex items-center justify-center" title="Reject">
                                            <i class="ri-close-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mb-3">
                                        <i class="ri-checkbox-circle-line text-2xl"></i>
                                    </div>
                                    <p class="text-sm">Tidak ada aplikasi pending. Semua pekerjaan selesai!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 2. TAMPILAN MOBILE (CARD LIST) --}}
            <div class="md:hidden flex flex-col divide-y divide-gray-100">
                @forelse($pendingApps as $app)
                <div class="p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h4 class="font-bold text-gray-900 text-base mb-1">{{ $app->name }}</h4>
                            <span class="text-[10px] uppercase font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded border border-gray-200">
                                {{ $app->category }}
                            </span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-medium">
                            {{ $app->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2 mb-5 text-sm text-gray-600 bg-gray-50 p-2 rounded-lg border border-gray-100">
                        <i class="ri-user-smile-line text-blue-500"></i>
                        <span>Partner: <strong>{{ $app->user->name }}</strong></span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- Tombol Reject --}}
                        <form action="{{ route('admin.saas.reject', $app->id) }}" method="POST" class="w-full" onsubmit="confirmSubmit(event, 'Tolak aplikasi ini?')">
                            @csrf
                            <button class="w-full py-2 bg-white border border-red-200 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-50 flex justify-center items-center gap-2 transition">
                                <i class="ri-close-circle-line"></i> Tolak
                            </button>
                        </form>
                        {{-- Tombol Approve --}}
                        <form action="{{ route('admin.saas.approve', $app->id) }}" method="POST" class="w-full">
                            @csrf
                            <button class="w-full py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 shadow-sm flex justify-center items-center gap-2 transition">
                                <i class="ri-checkbox-circle-line"></i> Setujui
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-gray-500 text-sm">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="ri-inbox-line text-xl"></i>
                    </div>
                    Tidak ada data pending.
                </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection