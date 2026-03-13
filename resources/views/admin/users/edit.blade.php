@extends('layouts.admin-app')

@section('title', 'Edit User')
@section('header_title', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.users.index') }}" class="p-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 transition">
            <i class="ri-arrow-left-line"></i>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Edit Profil: {{ $user->name }}</h2>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        @csrf
        @method('PUT')

        {{-- Flash Message Error --}}
        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- No HP --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Alamat (Full Width) --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('address', $user->address) }}</textarea>
            </div>

            {{-- Password Change (Optional) --}}
            <div class="md:col-span-2 pt-6 border-t border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-lock-password-line text-blue-600"></i> Ganti Password (Opsional)
                </h4>
                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100 mb-4">
                    <p class="text-sm text-yellow-800">
                        <i class="ri-information-fill"></i> Kosongkan kolom ini jika tidak ingin mengubah password user.
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Minimal 8 karakter">
                </div>
            </div>

        </div>

        <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-lg font-bold">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection