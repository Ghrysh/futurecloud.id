@extends('layouts.landing')

@section('title', 'Daftarkan Aplikasi SaaS')

@section('styles')
    {{-- CSS Cropper.js untuk fitur Crop Gambar --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    
    <style>
        /* Custom Scrollbar untuk Textarea */
        textarea::-webkit-scrollbar { width: 8px; }
        textarea::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        textarea::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        textarea::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Style untuk Container Crop */
        .img-container {
            max-height: 500px;
            background-color: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
        }
        .img-container img {
            max-width: 100%;
            display: block;
        }
    </style>
@endsection

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Partner Program</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3">Daftarkan Produk Anda</h1>
            <p class="text-gray-500 mt-2 max-w-2xl mx-auto">Bergabunglah dengan ekosistem FutureCloud dan tawarkan solusi SaaS Anda kepada ribuan pelanggan kami.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            {{-- Progress Bar Hiasan --}}
            <div class="h-1.5 w-full bg-gray-100">
                <div class="h-full bg-blue-600 w-1/3 rounded-r-full"></div>
            </div>

            <div class="p-8 md:p-10">
                
                {{-- 1. Pesan Error dari Controller (Manual) --}}
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="ri-error-warning-fill text-xl"></i>
                        <span class="font-bold">Gagal Menyimpan</span>
                    </div>
                    <p class="mt-1 text-sm">{{ session('error') }}</p>
                </div>
            @endif

            {{-- 2. Pesan Error Validasi (Otomatis Laravel) --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="ri-close-circle-line text-xl"></i>
                        <span class="font-bold">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form id="partnerForm" action="{{ route('partner.saas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- SECTION 1: INFO DASAR -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-6 pb-2 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">1</div>
                            Informasi Dasar
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Aplikasi</label>
                                <input type="text" name="name" required 
                                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                                       placeholder="Contoh: TaskFlow Pro">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                <div class="relative">
                                    <i class="ri-arrow-down-s-line absolute right-4 top-3.5 text-gray-400 pointer-events-none"></i>
                                    <select name="category" class="w-full border border-gray-300 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        <option value="Productivity">Productivity</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Sales">Sales</option>
                                        <option value="HR">HR</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Design">Design</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tagline Singkat</label>
                            <input type="text" name="tagline" required 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                                   placeholder="Contoh: Solusi manajemen proyek #1 untuk tim remote">
                            <p class="text-xs text-gray-400 mt-1">Akan muncul di kartu aplikasi. Maksimal 100 karakter.</p>
                        </div>
                    </div>

                    <!-- SECTION 2: DETAIL & HARGA -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-6 pb-2 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">2</div>
                            Detail & Penawaran
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                                <textarea name="description" rows="5" required 
                                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                                          placeholder="Jelaskan secara detail tentang keunggulan aplikasi Anda..."></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Mulai (Bulanan)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 text-gray-500 font-semibold">Rp</span>
                                        <input type="number" name="price" required 
                                               class="w-full border border-gray-300 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                                               placeholder="100000">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fitur Utama</label>
                                    <textarea name="features" rows="3" required 
                                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                                              placeholder="Unlimited Projects&#10;24/7 Support&#10;Analytics Dashboard"></textarea>
                                    <p class="text-xs text-gray-400 mt-1">Pisahkan setiap fitur dengan baris baru (Enter).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: MEDIA (IMAGE CROPPER) -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-6 pb-2 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">3</div>
                            Media Gambar
                        </h3>

                        <div class="bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300 p-8 text-center hover:bg-blue-50/50 hover:border-blue-300 transition relative" id="dropzone">
                            
                            {{-- Input File Asli (Hidden) --}}
                            <input type="file" name="thumbnail" id="imageInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                            
                            <div class="space-y-4 pointer-events-none">
                                <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mx-auto text-blue-500 text-3xl">
                                    <i class="ri-image-add-line"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-semibold">Klik atau Drag gambar ke sini</p>
                                    <p class="text-sm text-gray-500 mt-1">Format JPG/PNG. Rasio Landscape (16:9) disarankan.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Preview Hasil Crop --}}
                        <div id="previewContainer" class="hidden mt-6 animate-fade-in">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Preview Gambar Terpilih:</p>
                            <div class="relative w-full md:w-2/3 rounded-xl overflow-hidden shadow-md border border-gray-200 group">
                                <img id="croppedImageResult" src="" alt="Preview" class="w-full h-auto object-cover">
                                {{-- Tombol Ganti --}}
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <button type="button" onclick="document.getElementById('imageInput').click()" class="bg-white text-gray-800 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-100">
                                        Ganti Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL SUBMIT -->
                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200 transform hover:-translate-y-0.5">
                            Kirim Pendaftaran Aplikasi
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4">
                            Dengan mendaftar, Anda menyetujui Syarat & Ketentuan Partner FutureCloud.
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL CROPPER --}}
<div id="cropModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
            
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900" id="modal-title">Sesuaikan Ukuran Gambar</h3>
                    <button type="button" onclick="closeCropModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                
                {{-- Area Canvas Cropper --}}
                <div class="img-container h-[400px] w-full bg-black flex items-center justify-center">
                    <img id="imageToCrop" src="" alt="Picture">
                </div>
                
                <p class="text-xs text-gray-500 mt-3 flex items-center gap-1">
                    <i class="ri-information-line"></i> Geser dan zoom untuk menyesuaikan area gambar.
                </p>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                <button type="button" id="cropButton" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 sm:w-auto">
                    <i class="ri-crop-line mr-2"></i> Potong & Simpan
                </button>
                <button type="button" onclick="closeCropModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    {{-- Memuat Library Cropper.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('imageInput');
            const cropModal = document.getElementById('cropModal');
            const imageToCrop = document.getElementById('imageToCrop');
            const cropButton = document.getElementById('cropButton');
            const previewContainer = document.getElementById('previewContainer');
            const croppedImageResult = document.getElementById('croppedImageResult');
            const dropzone = document.getElementById('dropzone');
            
            let cropper;

            // 1. Saat File Dipilih
            imageInput.addEventListener('change', function (e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    
                    if (/^image\/\w+/.test(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            // Reset Cropper jika sudah ada
                            if (cropper) {
                                cropper.destroy();
                            }
                            
                            // Set gambar ke modal
                            imageToCrop.src = e.target.result;
                            
                            // Tampilkan Modal
                            cropModal.classList.remove('hidden');
                            
                            // Inisialisasi Cropper setelah gambar dimuat
                            // Kita beri timeout sedikit agar modal render dulu
                            setTimeout(() => {
                                cropper = new Cropper(imageToCrop, {
                                    aspectRatio: 16 / 9, // Rasio Landscape (Youtube Thumbnail Style)
                                    viewMode: 1, // Membatasi crop box agar tidak keluar gambar
                                    autoCropArea: 1,
                                    responsive: true,
                                });
                            }, 100);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        customAlert('Mohon pilih file gambar yang valid.')
                    }
                }
            });

            // 2. Tombol Crop Diklik
            cropButton.addEventListener('click', function () {
                if (!cropper) return;

                // Ambil hasil crop sebagai Canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 800, // Resize lebar output agar tidak terlalu besar
                    height: 450,
                });

                // Konversi ke Blob dan Ganti File Input
                canvas.toBlob(function (blob) {
                    // Buat File object baru dari Blob
                    const file = new File([blob], "cropped_thumbnail.webp", { type: "image/jpeg" });
                    
                    // Gunakan DataTransfer untuk memanipulasi input file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageInput.files = dataTransfer.files;

                    // Tampilkan Preview di Form
                    croppedImageResult.src = canvas.toDataURL('image/jpeg');
                    previewContainer.classList.remove('hidden');
                    dropzone.classList.add('hidden'); // Sembunyikan dropzone agar rapi

                    // Tutup Modal
                    closeCropModal();
                }, 'image/jpeg');
            });

            // 3. Fungsi Tutup Modal
            window.closeCropModal = function() {
                cropModal.classList.add('hidden');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                // Jika user batal crop tapi belum ada gambar sebelumnya, reset input
                if (dropzone.classList.contains('hidden') === false) {
                    imageInput.value = ''; 
                }
            };
        });
    </script>
@endsection