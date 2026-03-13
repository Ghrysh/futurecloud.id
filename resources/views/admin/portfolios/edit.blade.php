@extends('layouts.admin-app')

@section('title', 'Edit Portfolio')
@section('header_title', 'Edit Portfolio')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 transition">
            <i class="ri-arrow-left-line mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4 flex items-center gap-2">
                <i class="ri-edit-box-line text-blue-600"></i> Edit Project: {{ $portfolio->title }}
            </h2>

            <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    {{-- Judul Project --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Project / Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" required>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none bg-white">
                            @php $cats = ['Web Development', 'Mobile App', 'UI/UX Design', 'SaaS Application', 'Cloud Infrastructure']; @endphp
                            @foreach($cats as $cat)
                                <option value="{{ $cat }}" {{ (old('category', $portfolio->category) == $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Client Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Klien</label>
                        <input type="text" name="client" value="{{ old('client', $portfolio->client) }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none">
                    </div>

                    {{-- URL Project --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Project</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                Link
                            </span>
                            <input type="text" name="url" value="{{ old('url', $portfolio->url) }}" 
                                class="flex-1 px-4 py-2.5 rounded-r-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Detail <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none" required>{{ old('description', $portfolio->description) }}</textarea>
                    </div>

                    {{-- Upload Gambar (Dengan Preview Gambar Lama) --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                        
                        <div class="flex flex-col md:flex-row gap-6">
                            {{-- Preview Lama / Saat Ini --}}
                            <div class="w-full md:w-1/3">
                                <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                                <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm relative group h-40">
                                    <img src="{{ Storage::url($portfolio->image) }}" class="w-full h-full object-cover">
                                </div>
                            </div>

                            {{-- Input Upload Baru --}}
                            <div class="w-full md:w-2/3">
                                <p class="text-xs text-gray-500 mb-2">Ganti Gambar (Kosongkan jika tidak ingin mengubah):</p>
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500" id="upload-placeholder">
                                        <i class="ri-image-edit-line text-3xl mb-2"></i>
                                        <p class="text-sm">Klik untuk ganti gambar</p>
                                    </div>
                                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                                    <input id="dropzone-file" type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event)" />
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                        Update Project
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
            placeholder.classList.add('opacity-0');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection