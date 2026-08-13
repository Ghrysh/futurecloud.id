@extends('layouts.admin-app')

@section('title', isset($saas) ? 'Edit Aplikasi' : 'Tambah Aplikasi')
@section('header_title', isset($saas) ? 'Edit Aplikasi' : 'Tambah Aplikasi Baru')

@section('content')
@php
    $initialData = old() ?: (isset($saas) ? $saas->toArray() : []);
    
    // Process plans into an array for Alpine
    $plansArray = [];
    if (isset($initialData['plans']) && is_array($initialData['plans'])) {
        foreach($initialData['plans'] as $key => $plan) {
            if (!in_array($key, ['is_external_url_active', 'external_url', 'cycle', 'annual_discount_type', 'annual_discount_value'])) {
                if (isset($plan['features']) && is_array($plan['features'])) {
                    $plan['features_raw'] = implode(', ', $plan['features']);
                }
                $plansArray[] = array_merge($plan, ['key' => $key]);
            }
        }
    }
    
    $initialData['plans_array'] = empty($plansArray) ? null : $plansArray;
@endphp
<div class="max-w-5xl mx-auto" x-data="saasForm({{ json_encode($initialData) }})">

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <i class="ri-error-warning-fill text-red-500 text-xl mr-2"></i>
                <h3 class="text-red-800 font-bold">Terjadi Kesalahan!</h3>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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
                        @php $cat = old('category', $saas->category ?? ''); @endphp
                        <option value="Productivity" {{ $cat == 'Productivity' ? 'selected' : '' }}>Productivity</option>
                        <option value="Security" {{ $cat == 'Security' ? 'selected' : '' }}>Security</option>
                        <option value="Marketing" {{ $cat == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Finance" {{ $cat == 'Finance' ? 'selected' : '' }}>Finance</option>
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
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="font-bold text-gray-800">Konfigurasi Paket (Plans)</h3>
                <button type="button" @click="addPlan()" class="text-sm bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg font-bold hover:bg-blue-100 transition"><i class="ri-add-line mr-1"></i>Tambah Paket</button>
            </div>
            
            <div class="space-y-6">
                {{-- Loop Plans --}}
                <template x-for="(plan, index) in plans" :key="plan.key">
                    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 relative">
                        <button type="button" @click="removePlan(index)" class="absolute top-3 right-3 text-red-400 hover:text-red-600 bg-white rounded-md p-1 shadow-sm border border-gray-100"><i class="ri-delete-bin-line text-lg"></i></button>
                        
                        <div class="grid grid-cols-2 gap-3 mb-2 pr-8">
                            <input type="text" :name="`plans[${plan.key}][name]`" x-model="plan.name" placeholder="Nama Paket (ex: Starter)" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                            <input type="number" :name="`plans[${plan.key}][price]`" x-model="plan.price" placeholder="Harga" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        </div>
                        {{-- Fitur Paket --}}
                        <textarea :name="`plans[${plan.key}][features_raw]`" x-model="plan.features_raw" rows="2" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700 mt-2" placeholder="Fitur dipisah koma (ex: 5 User, 10GB)"></textarea>
                    </div>
                </template>
            </div>
            
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h3 class="font-bold text-gray-800 mb-4">Pengaturan Siklus Tagihan Global</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Siklus Tagihan</label>
                        <select name="plans[cycle]" x-model="form.cycle" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                            <option value="monthly">Bulanan (Monthly)</option>
                            <option value="annually">Tahunan (Annually)</option>
                            <option value="monthly_yearly">Bulanan & Tahunan (Bisa Pilih)</option>
                            <option value="lifetime">Sekali Bayar (Lifetime)</option>
                        </select>
                    </div>
                    
                    <div x-show="form.cycle === 'monthly_yearly' || form.cycle === 'annually'" class="p-4 bg-gray-50 rounded-lg border border-gray-200 mt-4 space-y-4">
                        <p class="text-sm text-gray-600 mb-2"><strong>Pengaturan Diskon Tahunan</strong><br>Jika memilih opsi tahunan, harga dasar (per bulan dari masing-masing paket) akan dikali 12, lalu dikurangi diskon berikut.</p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                                <select name="plans[annual_discount_type]" x-model="form.annual_discount_type" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                                    <option value="percent">Persentase (%)</option>
                                    <option value="fixed">Nominal (Rp)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                                <input type="number" name="plans[annual_discount_value]" x-model="form.annual_discount_value" placeholder="Contoh: 10 atau 50000" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM PENGATURAN URL EKSTERNAL --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan URL Eksternal</h3>
            
            <div class="space-y-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="plans[is_external_url_active]" value="0">
                    <input type="checkbox" name="plans[is_external_url_active]" value="1" x-model="form.is_external_url_active" class="rounded text-blue-600 focus:ring-blue-500 w-5 h-5">
                    <span class="text-sm font-medium text-gray-700">Aktifkan Redirect ke URL Eksternal</span>
                </label>
                
                <div x-show="form.is_external_url_active" class="mt-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Eksternal Tujuan</label>
                    <input type="url" name="plans[external_url]" x-model="form.external_url" placeholder="https://contoh.com/beli" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                    <p class="text-xs text-gray-500 mt-1">Jika diaktifkan, saat diklik pada marketplace pengunjung akan langsung diarahkan ke URL ini alih-alih masuk ke halaman detail aplikasi.</p>
                </div>
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
                description: data.description || '',
                is_external_url_active: (data.plans && data.plans.is_external_url_active == '1') ? true : false,
                external_url: (data.plans && data.plans.external_url) ? data.plans.external_url : '',
                cycle: (data.plans && data.plans.cycle) ? data.plans.cycle : 'monthly_yearly',
                annual_discount_type: (data.plans && data.plans.annual_discount_type) ? data.plans.annual_discount_type : 'percent',
                annual_discount_value: (data.plans && data.plans.annual_discount_value) ? data.plans.annual_discount_value : 0,
            },
            // Struktur Default Plans
            plans: data.plans_array || [
                { key: 'plan_' + Date.now(), name: 'Paket Dasar', price: 0, features_raw: '' }
            ],

            addPlan() {
                this.plans.push({ key: 'plan_' + Date.now(), name: '', price: 0, features_raw: '' });
            },

            removePlan(index) {
                if(this.plans.length > 1) {
                    this.plans.splice(index, 1);
                } else {
                    alert('Minimal harus ada 1 paket.');
                }
            },

            init() {
                // Auto slug
                this.$watch('form.name', (val) => {
                    if (!data.id && val) { // Hanya auto slug saat create
                        this.form.slug = val.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                    }
                });
            }
        }
    }
</script>
@endsection