@extends('layouts.partner-app')

@section('title', 'Edit Aplikasi')
@section('header_title', 'Edit: ' . $app->name)

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('partner.app.update', $app->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') {{-- Wajib untuk update data --}}

            {{-- Nama & Kategori --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                    <input type="text" name="name" value="{{ old('name', $app->name) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none">
                        @foreach(['Productivity', 'Marketing', 'Sales', 'HR', 'Finance', 'Design'] as $cat)
                            <option value="{{ $cat }}" {{ $app->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tagline --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tagline Singkat</label>
                <input type="text" name="tagline" value="{{ old('tagline', $app->tagline) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                <textarea name="description" rows="5" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none">{{ old('description', $app->description) }}</textarea>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp/bulan)</label>
                <input type="number" name="price" value="{{ old('price', $app->price) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none">
            </div>

            {{-- Gambar --}}
            <div class="border-t border-gray-100 pt-6">
                <label class="block text-sm font-medium text-gray-700 mb-4">Thumbnail Aplikasi</label>
                
                <div class="flex flex-col md:flex-row items-start gap-6">
                    {{-- Preview Gambar Lama --}}
                    <div class="w-48 h-28 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative bg-gray-100">
                        {{-- Menggunakan Str::startsWith untuk handling path gambar --}}
                        <img src="{{ Str::startsWith($app->thumbnail, 'http') ? $app->thumbnail : asset('storage/'.$app->thumbnail) }}" class="w-full h-full object-cover">
                        <span class="absolute bottom-0 left-0 w-full bg-black/50 text-white text-xs text-center py-1">Gambar Saat Ini</span>
                    </div>

                    {{-- Input Gambar Baru --}}
                    <div class="flex-1 w-full">
                        <input type="file" name="thumbnail" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-purple-600 text-white rounded-lg font-bold hover:bg-purple-700 transition shadow-md">
                    Simpan Perubahan
                </button>
                <a href="{{ route('partner.apps.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection