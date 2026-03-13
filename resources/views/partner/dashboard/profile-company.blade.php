@extends('layouts.partner-app')

@section('title', 'Profil Perusahaan')
@section('header_title', 'Profil Bisnis')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-purple-50/30 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                <i class="ri-building-4-line"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Informasi Bisnis</h3>
                <p class="text-xs text-gray-500">Data ini digunakan untuk verifikasi dan ditampilkan ke pelanggan.</p>
            </div>
        </div>

        <div class="p-8">
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="bg-green-50 text-green-700 p-3 rounded-lg mb-6 text-sm font-medium border border-green-100 flex items-center gap-2">
                    <i class="ri-checkbox-circle-fill text-lg"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('partner.company.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Perusahaan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan / Brand</label>
                    <div class="relative">
                        <i class="ri-store-line absolute left-4 top-3 text-gray-400"></i>
                        <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" required 
                               class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-500 outline-none transition">
                    </div>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon Bisnis</label>
                    <div class="relative">
                        <i class="ri-phone-line absolute left-4 top-3 text-gray-400"></i>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required 
                               class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-500 outline-none transition">
                    </div>
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-purple-500 outline-none transition">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white rounded-lg font-bold hover:bg-purple-700 transition shadow-md flex items-center gap-2">
                        <i class="ri-save-line"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection