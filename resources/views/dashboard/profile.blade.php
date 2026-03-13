@extends('layouts.client-app')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header Halaman -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">My Profile</h2>
                <p class="text-gray-500 text-sm">Kelola informasi akun dan preferensi keamanan Anda.</p>
            </div>
        </div>

        <!-- 1. CARD: INFORMASI PROFIL -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Card Header --}}
            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class="ri-user-line text-xl"></i> {{-- Menggunakan Remix Icon --}}
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Informasi Pribadi</h3>
                    <p class="text-xs text-gray-500">Perbarui nama tampilan dan email Anda.</p>
                </div>
            </div>
            
            <div class="p-6 md:p-8 flex flex-col md:flex-row gap-8">
                
                <!-- Sisi Kiri: Foto Profil -->
                <div class="flex flex-col items-center gap-3 md:w-1/3">
                    <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-md" 
                         src="{{ Auth::user()->profile_photo_url }}" 
                         alt="{{ Auth::user()->name }}">
                    
                    <div class="flex items-center gap-2 px-3 py-1 bg-gray-100 rounded-full text-xs font-medium text-gray-600 border border-gray-200">
                        @if(Auth::user()->google_id)
                            <i class="ri-google-fill text-blue-500 text-sm"></i> <span>Google Account</span>
                        @else
                            <i class="ri-mail-fill text-gray-500 text-sm"></i> <span>Email Account</span>
                        @endif
                    </div>
                </div>

                <!-- Sisi Kanan: Form Edit -->
                <div class="flex-1 md:w-2/3">
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        {{-- Username --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                            @error('username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- First Name --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                                @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            {{-- Last Name --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                                @error('last_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Email Readonly --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <i class="ri-lock-line absolute left-3 top-2.5 text-gray-400"></i>
                                <input type="email" value="{{ Auth::user()->email }}" readonly 
                                       class="w-full border border-gray-200 bg-gray-50 text-gray-500 rounded-lg pl-10 pr-4 py-2 cursor-not-allowed text-sm">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1">Email tidak dapat diubah secara langsung.</p>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- CARD 2: Hapus Akun (Danger Zone) -->
        <div class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden">
            <div class="p-6 border-b border-red-50 bg-red-50/30 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                    <i class="ri-alarm-warning-line text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Zona Bahaya</h3>
                    <p class="text-xs text-gray-500">Hapus akun dan data permanen.</p>
                </div>
            </div>
            
            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="max-w-xl text-sm text-gray-600">
                    <p>Setelah akun Anda dihapus, semua sumber daya dan data (termasuk riwayat transaksi dan layanan aktif) akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                        class="px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-50 transition whitespace-nowrap">
                    Hapus Akun
                </button>
            </div>
        </div>

    </div>

    {{-- MODAL HAPUS AKUN (Include dari Partial Breeze) --}}
    @include('profile.partials.delete-user-form') 

@endsection