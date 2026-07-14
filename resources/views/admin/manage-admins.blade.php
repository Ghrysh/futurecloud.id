@extends('layouts.admin-app')

@section('title', 'Kelola Admin')
@section('header_title', 'Manajemen Administrator')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
    
    {{-- 1. FORM TAMBAH ADMIN (Kiri/Atas) --}}
    <div class="lg:col-span-1">
        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 sticky top-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="ri-user-add-line"></i>
                </div>
                Tambah Admin Baru
            </h3>
            
            <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <i class="ri-id-card-line absolute left-3 top-2.5 text-gray-400"></i>
                        <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                               class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1.5">Username</label>
                    <div class="relative">
                        <i class="ri-hashtag absolute left-3 top-2.5 text-gray-400"></i>
                        <input type="text" name="username" required placeholder="admin_budi"
                               class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1.5">Password</label>
                    <div class="relative">
                        <i class="ri-lock-password-line absolute left-3 top-2.5 text-gray-400"></i>
                        <input type="password" name="password" required placeholder="********"
                               class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
                
                <div class="pt-2">
                    <button class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-sm flex items-center justify-center gap-2">
                        <i class="ri-save-line"></i> Simpan Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 2. LIST ADMIN (Kanan/Bawah) --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5 md:p-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                    <i class="ri-team-line text-gray-500"></i> Daftar Admin
                </h3>
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $admins->count() }} User</span>
            </div>

            {{-- TAMPILAN DESKTOP (TABLE) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama</th>
                            <th class="px-6 py-4 font-semibold">Username</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($admins as $admin)
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold">
                                        {{ substr($admin->name, 0, 1) }}
                                    </div>
                                    {{ $admin->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $admin->username }}</td>
                            <td class="px-6 py-4 text-right">
                                @if(Auth::guard('admin')->id() != $admin->id)
                                    <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Yakin ingin menghapus admin ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700 hover:bg-red-50 px-3 py-1.5 rounded-md transition text-xs font-medium flex items-center gap-1 ml-auto">
                                            <i class="ri-delete-bin-line"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center gap-1 text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                        <i class="ri-user-smile-line"></i> Anda
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- TAMPILAN MOBILE (CARD LIST) --}}
            <div class="md:hidden flex flex-col divide-y divide-gray-100">
                @foreach($admins as $admin)
                <div class="p-5 flex items-center justify-between hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        {{-- Avatar --}}
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold shadow-sm border border-slate-200">
                            {{ substr($admin->name, 0, 1) }}
                        </div>
                        
                        {{-- Info --}}
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">{{ $admin->name }}</h4>
                            <p class="text-xs text-gray-500 font-mono">@ {{ $admin->username }}</p>
                        </div>
                    </div>

                    {{-- Action --}}
                    <div>
                        @if(Auth::guard('admin')->id() != $admin->id)
                            <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="confirmSubmit(event, 'Hapus?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 flex items-center justify-center bg-white border border-red-200 text-red-500 rounded-lg shadow-sm hover:bg-red-50 transition">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </form>
                        @else
                            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded border border-green-100">Anda</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection