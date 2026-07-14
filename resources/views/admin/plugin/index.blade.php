@extends('layouts.admin-app')

@section('title', 'Kelola Plugin')
@section('header_title', 'Manajemen Aplikasi Plugin')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Header Card --}}
        <div class="p-5 md:p-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <i class="ri-apps-2-line text-blue-500"></i> Daftar Aplikasi
            </h3>

            {{-- Tombol Tambah --}}
            <a href="{{ route('admin.plugin.create') }}"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                <i class="ri-add-line"></i> Tambah Aplikasi
            </a>
        </div>

        {{-- 1. TAMPILAN DESKTOP (TABLE) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 font-semibold uppercase text-xs border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Aplikasi</th>
                        <th class="px-6 py-4">Partner / Owner</th>
                        <th class="px-6 py-4">Harga Mulai</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($apps as $app)
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @php
                                        $imgSrc = $app->thumbnail;
                                        if (Str::startsWith($imgSrc, 'http')) {
                                            // do nothing, already absolute
                                        } elseif (Str::startsWith($imgSrc, 'assets/')) {
                                            $imgSrc = asset($imgSrc);
                                        } elseif (Str::startsWith($imgSrc, 'storage/')) {
                                            $imgSrc = asset($imgSrc);
                                        } else {
                                            $imgSrc = asset('storage/' . $imgSrc);
                                        }
                                    @endphp
                                    <img src="{{ $imgSrc }}"
                                        class="w-10 h-10 rounded-lg object-cover border border-gray-200 shadow-sm">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $app->name }}</p>
                                        <span
                                            class="text-[10px] uppercase font-bold text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">
                                            {{ $app->category }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @php
                                    // Logika Cek Owner
                                    // Jika User ID 1 (Super Admin) atau Role Admin, anggap Official
                                    $isOfficial = $app->user_id == 1 || ($app->user->role ?? '') == 'admin';
                                @endphp

                                @if ($isOfficial)
                                    <div class="flex items-center gap-1.5">
                                        <i class="ri-verified-badge-fill text-blue-500 text-lg"></i>
                                        <span class="font-bold text-blue-700">FutureCloud Official</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <i class="ri-user-smile-line text-gray-400"></i>
                                        {{ $app->user->name }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-mono font-medium text-gray-700">
                                Rp {{ number_format($app->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($app->status == 'approved')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">Live</span>
                                @elseif($app->status == 'rejected')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">Rejected</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 border border-yellow-200">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.plugin.edit', $app->id) }}"
                                        class="p-1.5 text-gray-500 hover:text-orange-600 hover:bg-orange-50 rounded transition"
                                        title="Edit">
                                        <i class="ri-pencil-line text-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.plugin.destroy', $app->id) }}" method="POST"
                                        onsubmit="confirmSubmit(event, 'Hapus aplikasi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded transition"
                                            title="Hapus">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">Belum ada aplikasi terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
