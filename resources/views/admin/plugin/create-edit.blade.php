@extends('layouts.admin-app')

@section('title', isset($plugin) ? 'Edit Aplikasi' : 'Tambah Aplikasi')
@section('header_title', isset($plugin) ? 'Edit Aplikasi' : 'Tambah Aplikasi Baru')

@section('content')
<div class="max-w-5xl mx-auto" x-data="saasForm({{ isset($plugin) ? json_encode($plugin) : '{}' }})">
    
    <form action="{{ isset($plugin) ? route('admin.plugin.update', $plugin->id) : route('admin.plugin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($plugin)) @method('PUT') @endif

        {{-- KOLOM KIRI: INFO DASAR --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Informasi Dasar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi</label>
                    <input type="text" name="name" x-model="form.name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug (URL)</label>
                    <input type="text" name="slug" x-model="form.slug" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="hidden" name="category" value="Plugin">
                    <div class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                        Plugin
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga Mulai (Rp)</label>
                    <input type="number" name="price" x-model="form.price" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tagline Singkat</label>
                    <input type="text" name="tagline" x-model="form.tagline" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar / Thumbnail Plugin</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if(isset($plugin) && $plugin->thumbnail && $plugin->thumbnail !== 'assets/img/placeholder.jpg')
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Thumbnail saat ini:</p>
                            <img src="{{ asset($plugin->thumbnail) }}" alt="Thumbnail" class="h-20 rounded-md border border-gray-200">
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap & Fitur</label>
                    <textarea name="description" rows="5" x-model="form.description" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700"></textarea>
                    <p class="text-xs text-gray-400 mt-1">Gunakan tanda strip (-) di awal baris untuk membuat list fitur.</p>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: PENGATURAN HARGA --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan Harga</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Siklus Tagihan</label>
                    <select name="cycle" x-model="form.cycle" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        <option value="monthly">Bulanan (Monthly)</option>
                        <option value="annually">Tahunan (Annually)</option>
                        <option value="monthly_yearly">Bulanan & Tahunan (Bisa Pilih)</option>
                        <option value="lifetime">Sekali Bayar (Lifetime)</option>
                    </select>
                </div>
                
                <div x-show="form.cycle === 'monthly_yearly' || form.cycle === 'annually'" class="p-4 bg-gray-50 rounded-lg border border-gray-200 mt-4 space-y-4">
                    <p class="text-sm text-gray-600 mb-2"><strong>Pengaturan Diskon Tahunan</strong><br>Jika memilih opsi tahunan, harga dasar (per bulan) akan dikali 12, lalu dikurangi diskon berikut.</p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                            <select name="annual_discount_type" x-model="form.annual_discount_type" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                                <option value="percent">Persentase (%)</option>
                                <option value="fixed">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                            <input type="number" name="annual_discount_value" x-model="form.annual_discount_value" placeholder="Contoh: 10 atau 50000" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.plugin.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition shadow-lg">Simpan Aplikasi</button>
        </div>
    </form>
</div>

<script>
    function saasForm(data) {
        return {
            form: {
                name: data.name || '',
                slug: data.slug || '',
                price: data.price || 0,
                tagline: data.tagline || '',
                description: data.description || '',
                cycle: (data.plans && data.plans.cycle) ? data.plans.cycle : 'lifetime',
                annual_discount_type: (data.plans && data.plans.annual_discount_type) ? data.plans.annual_discount_type : 'percent',
                annual_discount_value: (data.plans && data.plans.annual_discount_value) ? data.plans.annual_discount_value : 0,
            },

            init() {
                // Auto slug
                this.$watch('form.name', (val) => {
                    if (!data.id) { // Hanya auto slug saat create
                        this.form.slug = val.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                    }
                });
            }
        }
    }
</script>
@endsection