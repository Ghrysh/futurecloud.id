@extends('layouts.admin-app')

@section('title', 'Request Partner')
@section('header_title', 'Permintaan Menjadi Partner')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        {{-- Header Card --}}
        <div class="p-5 md:p-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <i class="ri-shake-hands-line text-blue-500"></i> Daftar Permintaan
            </h3>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded-full border border-blue-200">
                {{ $partners->count() }} Baru
            </span>
        </div>

        {{-- 1. TAMPILAN DESKTOP (TABLE) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 font-semibold uppercase text-xs border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Nama User</th>
                        <th class="px-6 py-4">Nama Perusahaan</th>
                        <th class="px-6 py-4">Tanggal Request</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($partners as $p)
                    <tr class="hover:bg-blue-50/30 transition group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                {{-- Avatar Inisial --}}
                                <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-xs border border-slate-200">
                                    {{ substr($p->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $p->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $p->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            <div class="flex items-center gap-2">
                                <i class="ri-building-4-line text-gray-400"></i>
                                {{ $p->company_name ?? '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs font-mono">
                            {{ $p->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.partners.show', $p->id) }}" 
                               class="inline-flex items-center gap-1 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-blue-600 hover:text-white hover:border-blue-600 transition font-medium text-xs shadow-sm group-hover:shadow-md">
                                Tinjau <i class="ri-arrow-right-line"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="ri-inbox-line text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-sm">Tidak ada permintaan partner baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. TAMPILAN MOBILE (CARD STACK) --}}
        <div class="md:hidden flex flex-col divide-y divide-gray-100">
            @forelse($partners as $p)
            <div class="p-5 hover:bg-gray-50 transition">
                
                {{-- Header Card --}}
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm border border-blue-100">
                            {{ substr($p->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $p->name }}</h4>
                            <p class="text-[10px] text-gray-500">{{ $p->email }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 font-mono bg-gray-100 px-2 py-0.5 rounded">
                        {{ $p->created_at->format('d/m') }}
                    </span>
                </div>

                {{-- Content Card --}}
                <div class="mb-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <span class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Perusahaan</span>
                    <div class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="ri-building-line text-blue-500"></i>
                        {{ $p->company_name ?? 'Tidak ada nama perusahaan' }}
                    </div>
                </div>

                {{-- Action Button --}}
                <a href="{{ route('admin.partners.show', $p->id) }}" 
                   class="flex items-center justify-center w-full py-2.5 bg-blue-600 text-white rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm gap-2">
                    <i class="ri-file-search-line text-sm"></i> Tinjau Permintaan
                </a>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500 text-sm">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="ri-inbox-line text-xl"></i>
                </div>
                Belum ada permintaan.
            </div>
            @endforelse
        </div>

    </div>
@endsection