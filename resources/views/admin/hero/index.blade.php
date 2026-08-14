@extends('layouts.admin-app')
@section('title', 'Hero Management')
@section('header_title', 'Kelola Hero Landing Page')

@section('content')
{{-- Added px-4 sm:px-6 for mobile padding --}}
<div class="max-w-6xl mx-auto space-y-6 sm:space-y-8 px-4 sm:px-6">
    
    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-lg border border-green-200 flex items-center gap-2 text-sm sm:text-base">
        <i class="ri-checkbox-circle-line text-xl flex-shrink-0"></i> 
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded-lg border border-red-200 flex items-center gap-2 text-sm sm:text-base">
        <i class="ri-error-warning-line text-xl flex-shrink-0"></i> 
        <span>{{ session('error') }}</span>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-lg border border-red-200 text-sm sm:text-base">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        
        {{-- 1. FORM TEKS --}}
        {{-- Changed sticky to lg:sticky so it doesn't float on mobile --}}
        <div class="lg:col-span-1 h-fit lg:sticky lg:top-6">
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-4 border-b pb-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <i class="ri-text text-lg"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm sm:text-base">1. Konten Teks</h3>
                </div>
                
                <form action="{{ route('admin.hero.update_text') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $hero->tagline ?? 'Next-Generation Cloud Platform') }}" 
                               class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Judul Utama</label>
                        <input type="text" name="title" value="{{ old('title', $hero->title ?? 'Future-Ready Cloud') }}" 
                               class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sub Judul</label>
                        <textarea name="subtitle" rows="4" 
                                  class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">{{ old('subtitle', $hero->subtitle ?? 'Empower your business with cutting‑edge cloud technology.') }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold hover:bg-blue-700 transition text-sm sm:text-base">
                        Simpan Teks
                    </button>
                </form>
            </div>
        </div>

        {{-- 2. MANAJEMEN GAMBAR --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- BOX UPLOAD --}}
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-4 border-b pb-2">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                        <i class="ri-image-add-line text-lg"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm sm:text-base">2. Tambah Slide Baru</h3>
                </div>

                {{-- DROPZONE (Auto Upload) --}}
                <div class="bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300 p-6 sm:p-8 text-center hover:bg-blue-50/50 hover:border-blue-300 transition relative cursor-pointer group" id="dropzone">
                    
                    {{-- Form Upload --}}
                    <form id="uploadForm" action="{{ route('admin.hero.add_image') }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 w-full h-full z-10">
                        @csrf
                        {{-- Input File --}}
                        <input type="file" name="image" id="imageInput" accept="image/*" class="w-full h-full opacity-0 cursor-pointer">
                    </form>
                    
                    {{-- UI Default --}}
                    <div id="uploadUiDefault" class="space-y-4 pointer-events-none group-hover:scale-105 transition transform duration-200 relative z-0">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white rounded-full shadow-sm flex items-center justify-center mx-auto text-blue-500 text-2xl sm:text-3xl">
                            <i class="ri-upload-cloud-2-line"></i>
                        </div>
                        <div>
                            <p class="text-gray-900 font-semibold text-sm sm:text-base">Klik area ini untuk upload</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1">Saran: Gunakan gambar landscape (16:9) agar tampilan optimal.</p>
                        </div>
                    </div>

                    {{-- UI Loading (Hidden Default) --}}
                    <div id="uploadUiLoading" class="hidden absolute inset-0 bg-white/80 z-20 flex-col items-center justify-center">
                        <i class="ri-loader-4-line text-3xl sm:text-4xl text-blue-600 animate-spin mb-2"></i>
                        <p class="text-blue-600 font-bold text-sm sm:text-base">Mengupload...</p>
                    </div>
                </div>
            </div>

            {{-- List Slide Aktif --}}
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2 text-sm sm:text-base">
                        <i class="ri-slideshow-line text-orange-500"></i> Slide Aktif
                    </h3>
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-600 font-medium">
                        Total: {{ count($hero->background_images ?? []) }}
                    </span>
                </div>

                <div class="space-y-3">
                    @php $images = $hero->background_images ?? ['assets/bg.jpg']; @endphp

                    @foreach($images as $index => $img)
                    <div class="flex items-center gap-3 sm:gap-4 p-2 sm:p-3 border border-gray-200 rounded-lg bg-white group hover:border-blue-300 transition">
                        
                        <div class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center bg-gray-100 rounded-full font-bold text-gray-500 text-xs sm:text-sm shrink-0">
                            {{ $index + 1 }}
                        </div>

                        {{-- Thumbnail Preview --}}
                        <div class="w-16 h-12 sm:w-24 sm:h-16 rounded-md overflow-hidden border border-gray-100 relative bg-gray-100 shrink-0">
                            @if(str_starts_with($img, 'assets/'))
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/'.$img) }}" class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] sm:text-xs text-gray-500 truncate font-mono">{{ basename($img) }}</p>
                            @if($img === 'assets/bg.jpg')
                                <span class="text-[9px] sm:text-[10px] bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full font-bold inline-block mt-1">Default</span>
                            @else
                                <span class="text-[9px] sm:text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-bold inline-block mt-1">Uploaded</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-1 shrink-0">
                            @if($index > 0)
                            <form action="{{ route('admin.hero.reorder_image') }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="image_path" value="{{ $img }}"><input type="hidden" name="direction" value="up">
                                <button type="submit" class="p-1.5 sm:p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded"><i class="ri-arrow-up-line text-sm sm:text-base"></i></button>
                            </form>
                            @endif
                            @if($index < count($images) - 1)
                            <form action="{{ route('admin.hero.reorder_image') }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="image_path" value="{{ $img }}"><input type="hidden" name="direction" value="down">
                                <button type="submit" class="p-1.5 sm:p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded"><i class="ri-arrow-down-line text-sm sm:text-base"></i></button>
                            </form>
                            @endif
                            @if($img !== 'assets/bg.jpg')
                                <form action="{{ route('admin.hero.delete_image') }}" method="POST" onsubmit="confirmSubmit(event, 'Hapus slide ini?')">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="image_path" value="{{ $img }}">
                                    <button type="submit" class="p-1.5 sm:p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded transition ml-1"><i class="ri-delete-bin-line text-sm sm:text-base"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- 3. PROMO BANNER POPUP --}}
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100 mt-6 sm:mt-8">
        <div class="flex items-center gap-2 mb-4 border-b pb-2">
            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center text-pink-600">
                <i class="ri-advertisement-line text-lg"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-sm sm:text-base">3. Banner Promo Popup</h3>
        </div>

        <form action="{{ route('admin.hero.update_promo') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_promo_active" class="sr-only peer" {{ ($hero->is_promo_active ?? false) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="text-sm font-bold text-gray-700">Aktifkan Promo Popup</span>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">URL Redirect (Opsional)</label>
                <input type="text" name="promo_url" value="{{ old('promo_url', $hero->promo_url ?? '') }}" placeholder="https://..."
                       class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                <p class="text-xs text-gray-500 mt-1">Ke mana pengunjung akan diarahkan saat gambar di-klik?</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Upload Gambar Banner</label>
                    <input type="file" name="promo_image" accept="image/*" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                    <p class="text-xs text-gray-500 mt-2">Maksimal 5MB. Saran: Gambar Portrait/Square (Misal 800x800 atau 600x800).</p>
                </div>
                
                @if(!empty($hero->promo_image))
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Banner Saat Ini</label>
                    <div class="border rounded-lg p-2 bg-gray-50 flex justify-center">
                        <img src="{{ asset('storage/' . $hero->promo_image) }}" alt="Promo Banner" class="max-h-48 rounded object-contain shadow-sm">
                    </div>
                </div>
                @endif
            </div>

            <button type="submit" class="bg-pink-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-pink-700 transition text-sm sm:text-base">
                Simpan Pengaturan Promo
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('imageInput');
        const uploadForm = document.getElementById('uploadForm');
        const uploadUiDefault = document.getElementById('uploadUiDefault');
        const uploadUiLoading = document.getElementById('uploadUiLoading');

        imageInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                uploadUiDefault.classList.add('hidden');
                uploadUiLoading.classList.remove('hidden');
                uploadUiLoading.classList.add('flex');
                uploadForm.submit();
            }
        });
    });
</script>
@endsection