@extends('layouts.admin-app')

@section('title', isset($saas) ? 'Edit Aplikasi' : 'Tambah Aplikasi')
@section('header_title', isset($saas) ? 'Edit Aplikasi' : 'Tambah Aplikasi Baru')

@section('content')
<div class="max-w-5xl mx-auto" x-data="saasForm({{ isset($saas) ? json_encode($saas) : '{}' }})">
    
    <form action="{{ isset($saas) ? route('admin.saas.update', $saas->id) : route('admin.saas.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($saas)) @method('PUT') @endif

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
                    <select name="category" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        <option>Productivity</option>
                        <option>Security</option>
                        <option>Marketing</option>
                        <option>Finance</option>
                    </select>
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap & Fitur</label>
                    <textarea name="description" rows="5" x-model="form.description" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700"></textarea>
                    <p class="text-xs text-gray-400 mt-1">Gunakan tanda strip (-) di awal baris untuk membuat list fitur.</p>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: PAKET HARGA (JSON BUILDER) --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Konfigurasi Paket (Plans)</h3>
            
            <div class="space-y-6">
                {{-- Loop Plans (Starter, Pro, etc) --}}
                <template x-for="(plan, key) in plans" :key="key">
                    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold uppercase text-xs text-blue-600" x-text="key"></span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mb-2">
                            <input type="text" :name="`plans[${key}][name]`" x-model="plan.name" placeholder="Nama Paket (ex: Starter)" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                            <input type="number" :name="`plans[${key}][price]`" x-model="plan.price" placeholder="Harga" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        </div>
                        {{-- Fitur Paket --}}
                        <textarea :name="`plans[${key}][features_raw]`" x-model="plan.features_raw" rows="2" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700 mt-2" placeholder="Fitur dipisah koma (ex: 5 User, 10GB)"></textarea>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.saas.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition">Batal</a>
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
                description: data.description || ''
            },
            // Struktur Default Plans
            plans: {
                starter: { name: 'Starter', price: 0, features_raw: '' },
                pro: { name: 'Pro', price: 0, features_raw: '' },
                enterprise: { name: 'Enterprise', price: 0, features_raw: '' }
            },

            init() {
                // Jika Edit, Load data plans dari DB
                if (data.plans) {
                    // Mapping features array ke string koma
                    for (const [key, val] of Object.entries(data.plans)) {
                        if(this.plans[key]) {
                            this.plans[key].name = val.name;
                            this.plans[key].price = val.price;
                            this.plans[key].features_raw = Array.isArray(val.features) ? val.features.join(', ') : '';
                        }
                    }
                }
                
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