@extends('layouts.partner-app')

@section('title', 'Kelola Aplikasi')
@section('header_title', 'Aplikasi Saya')

@section('content')
    <div class="space-y-6">
        
        {{-- ========================================================= --}}
        {{-- TAMPILAN DESKTOP (TABLE) - Hidden di Mobile (md:block) --}}
        {{-- ========================================================= --}}
        <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4">Kategori & Harga</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($myApps as $app)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @php
                                        $imgSrc = $app->thumbnail;
                                        if (!Str::startsWith($imgSrc, 'http')) {
                                            $imgSrc = asset('storage/' . $imgSrc);
                                        }
                                    @endphp
                                    <img src="{{ $imgSrc }}" class="w-12 h-12 rounded-lg object-cover border bg-gray-100">
                                    <div>
                                        <p class="font-bold text-gray-900 text-base">{{ $app->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $app->tagline }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs mb-1">{{ $app->category }}</span>
                                <p class="font-semibold text-gray-800">Rp {{ number_format($app->price) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($app->status == 'approved')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold flex items-center w-fit gap-1">
                                        <i class="ri-checkbox-circle-fill"></i> Live
                                    </span>
                                @elseif($app->status == 'rejected')
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold flex items-center w-fit gap-1">
                                        <i class="ri-close-circle-fill"></i> Ditolak
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold flex items-center w-fit gap-1">
                                        <i class="ri-time-fill"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('partner.app.edit', $app->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                        <i class="ri-edit-line text-lg"></i>
                                    </a>
                                    <form action="{{ route('partner.app.delete', $app->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Yakin hapus aplikasi ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- TAMPILAN MOBILE (CARD) - Hidden di Desktop (md:hidden) --}}
        {{-- ========================================================= --}}
        <div class="md:hidden space-y-4">
            @foreach($myApps as $app)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    {{-- Header Card: Gambar & Judul --}}
                    <div class="flex gap-4 mb-3">
                        @php
                            $imgSrc = $app->thumbnail;
                            if (!Str::startsWith($imgSrc, 'http')) {
                                $imgSrc = asset('storage/' . $imgSrc);
                            }
                        @endphp
                        <img src="{{ $imgSrc }}" class="w-16 h-16 rounded-lg object-cover border bg-gray-100 flex-shrink-0">
                        
                        <div class="overflow-hidden">
                            <h3 class="font-bold text-gray-900 text-base truncate">{{ $app->name }}</h3>
                            <p class="text-xs text-gray-500 truncate mb-1.5">{{ $app->tagline }}</p>
                            
                            {{-- Status Badge Mobile --}}
                            @if($app->status == 'approved')
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-[10px] font-bold inline-flex items-center gap-1">
                                    <i class="ri-checkbox-circle-fill"></i> Live
                                </span>
                            @elseif($app->status == 'rejected')
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded text-[10px] font-bold inline-flex items-center gap-1">
                                    <i class="ri-close-circle-fill"></i> Ditolak
                                </span>
                            @else
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-[10px] font-bold inline-flex items-center gap-1">
                                    <i class="ri-time-fill"></i> Pending
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Info Bar: Kategori & Harga --}}
                    <div class="flex justify-between items-center bg-gray-50 rounded-lg px-3 py-2 mb-4">
                        <span class="text-xs font-medium text-gray-600 bg-white border border-gray-200 px-2 py-0.5 rounded">{{ $app->category }}</span>
                        <span class="text-sm font-bold text-blue-700">Rp {{ number_format($app->price) }}</span>
                    </div>

                    {{-- Action Buttons (Full Width) --}}
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('partner.app.edit', $app->id) }}" class="flex items-center justify-center gap-2 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition">
                            <i class="ri-edit-line"></i> Edit
                        </a>
                        
                        <form action="{{ route('partner.app.delete', $app->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Yakin hapus aplikasi ini?')" class="w-full">
                            @csrf @method('DELETE')
                            <button class="w-full flex items-center justify-center gap-2 py-2 bg-red-50 border border-red-100 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition">
                                <i class="ri-delete-bin-line"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- EMPTY STATE (Tampil jika kosong di Desktop maupun Mobile) --}}
        @if($myApps->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <i class="ri-inbox-line text-3xl"></i>
                </div>
                <h3 class="text-gray-900 font-bold">Belum ada aplikasi</h3>
                <p class="text-gray-500 text-sm mt-1 mb-6">Mulai monetisasi software Anda sekarang.</p>
                <a href="{{ route('partner.saas.create') }}" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                    Upload Aplikasi Pertama
                </a>
            </div>
        @endif

    </div>
@endsection