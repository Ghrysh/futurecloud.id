@extends('layouts.admin-app')

@section('title', 'Tambah Project Baru')
@section('header_title', 'Tambah Portfolio')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 transition">
            <i class="ri-arrow-left-line mr-2"></i> Kembali ke Daftar Portfolio
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Form Project Baru</h2>

            <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    {{-- Judul Project --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Project / Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" 
                            placeholder="Contoh: Website E-Commerce Toko Baju" required>
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none bg-white">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Web Development" {{ old('category') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Mobile App" {{ old('category') == 'Mobile App' ? 'selected' : '' }}>Mobile App</option>
                            <option value="UI/UX Design" {{ old('category') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="SaaS Application" {{ old('category') == 'SaaS Application' ? 'selected' : '' }}>SaaS Application</option>
                            <option value="Cloud Infrastructure" {{ old('category') == 'Cloud Infrastructure' ? 'selected' : '' }}>Cloud Infrastructure</option>
                        </select>
                        @error('category') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Client Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Klien (Opsional)</label>
                        <input type="text" name="client" value="{{ old('client') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" 
                            placeholder="Contoh: PT. Maju Mundur">
                    </div>

                    {{-- URL Project --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Project (Opsional)</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                https://
                            </span>
                            <input type="text" name="url" value="{{ old('url') }}" 
                                class="flex-1 px-4 py-2.5 rounded-r-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" 
                                placeholder="www.projectanda.com">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Detail <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" 
                            placeholder="Jelaskan tantangan, solusi, dan hasil dari project ini..." required>{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama (Thumbnail) <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500 group-hover:text-blue-600" id="upload-placeholder">
                                    <i class="ri-upload-cloud-2-line text-4xl mb-3"></i>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs">PNG, JPG or WEBP (Max. 2MB)</p>
                                </div>
                                {{-- Preview Image (Hidden by default) --}}
                                <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                                
                                <input id="dropzone-file" type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event)" required />
                            </label>
                        </div>
                        @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                        Simpan Project
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('opacity-0'); // Sembunyikan placeholder text
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection