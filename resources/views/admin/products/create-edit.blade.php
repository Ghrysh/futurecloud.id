@extends('layouts.admin-app')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('header_title', isset($product) ? 'Edit Produk' : 'Tambah Produk Baru')

@section('content')
    <div class="max-w-5xl mx-auto">

        <form id="productForm" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200" x-data="productHandler()"
            x-init="initData()">

            {{-- ERROR HANDLING --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 p-4 rounded-xl border border-red-200">
                    <div class="flex items-center gap-2 mb-2 text-red-700 font-bold">
                        <i class="ri-error-warning-line text-xl"></i> Ada Input yang Salah
                    </div>
                    <ul class="list-disc list-inside text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                {{-- SECTION 1: INFORMASI DASAR --}}
                <div class="md:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-2 mb-4">Informasi Produk</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Produk</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach (['domain', 'hosting', 'vps', 'saas'] as $t)
                                <label
                                    class="flex items-center gap-2 cursor-pointer bg-gray-50 px-4 py-2 rounded-lg border border-gray-200 hover:border-blue-300 transition"
                                    :class="type === '{{ $t }}' ? 'bg-blue-50 border-blue-500 ring-1 ring-blue-500' :
                                        ''">
                                    <input type="radio" name="type" value="{{ $t }}" x-model="type"
                                        class="text-blue-600 focus:ring-blue-500">
                                    <span
                                        class="capitalize text-sm font-semibold {{ $t === old('type', $product->type ?? '') ? 'text-blue-700' : 'text-gray-600' }}">{{ $t }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk / TLD</label>
                            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Contoh: VPS Starter atau .COM">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                            <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="contoh: vps-starter">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori (Filter)</label>
                            <input type="text" name="category"
                                value="{{ old('category', $product->category ?? 'General') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Contoh: Popular, Business">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Siklus Tagihan Default</label>
                            <select name="cycle" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500">
                                <option value="mo"
                                    {{ old('cycle', $product->cycle ?? '') == 'mo' ? 'selected' : '' }}>Per Bulan (mo)
                                </option>
                                <option value="yr"
                                    {{ old('cycle', $product->cycle ?? '') == 'yr' ? 'selected' : '' }}>Per Tahun (yr)
                                </option>
                            </select>
                            <p class="text-[10px] text-gray-500 mt-1">*Pilih 'Per Tahun' jika produk adalah Domain</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Label Global (Badge)</label>
                            <input type="text" name="tag" value="{{ old('tag', $product->tag ?? '') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Contoh: Best Value, Recommended">
                        </div>

                        <div class="md:col-span-2 bg-blue-50 p-5 rounded-xl border border-blue-100">
                            <label class="block text-sm font-bold text-blue-900 mb-2">Harga Dasar (Base Price)</label>
                            <p class="text-xs text-blue-600 mb-3">
                                <span x-show="type === 'domain'">Masukkan harga <strong>Register Normal (1
                                        Tahun)</strong>.</span>
                                <span x-show="type !== 'domain'">Masukkan harga <strong>Bulanan Normal</strong>. Ini akan
                                    menjadi acuan dasar perhitungan otomatis.</span>
                            </p>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-blue-500 font-bold">Rp</span>
                                <input type="number" name="price" x-model="price"
                                    class="w-full pl-10 border-blue-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold text-lg text-blue-900">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: CONFIG HOSTING & VPS (DINAMIS PER SIKLUS) --}}
                <div x-show="type === 'hosting' || type === 'vps'" class="md:col-span-2" x-transition>
                    <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-2 mb-6 flex items-center gap-2">
                        <i class="ri-price-tag-3-line text-green-600"></i> Konfigurasi Harga & Promo (Per Siklus)
                    </h3>

                    <div class="space-y-6">
                        {{-- LOOP SIKLUS: BULANAN, 3 BULAN, TAHUNAN, 2 TAHUNAN --}}
                        @foreach (['monthly' => 'Bulanan (1 Bulan)', 'quarterly' => 'Triwulan (3 Bulan)', 'annually' => 'Tahunan (1 Tahun)', 'biennially' => 'Dua Tahun (2 Tahun)'] as $key => $label)
                            {{-- Card Siklus --}}
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 relative transition hover:shadow-md hover:border-blue-300"
                                x-show="(type === 'vps' || '{{ $key }}' !== 'quarterly') && (type === 'hosting' || '{{ $key }}' !== 'biennially')">

                                <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-2">
                                    <h5 class="font-bold text-gray-800 flex items-center gap-2">
                                        <i class="ri-calendar-check-line text-gray-400"></i> {{ $label }}
                                    </h5>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                                    {{-- 1. Harga Normal Custom (NEW FEATURE) --}}
                                    <div class="md:col-span-12 mb-2">
                                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Harga Normal
                                            Siklus Ini (Rp)</label>
                                        <div class="flex gap-2 items-center">
                                            <input type="number" name="discount_config[{{ $key }}][custom_price]"
                                                x-model="hostingVps.{{ $key }}.custom_price"
                                                class="w-full text-sm font-bold border-gray-300 rounded-lg focus:ring-blue-500 text-gray-800"
                                                placeholder="Otomatis (Base x Bulan)">
                                            <div class="text-xs text-gray-400 whitespace-nowrap">
                                                <span x-show="!hostingVps.{{ $key }}.custom_price">Auto: <span
                                                        x-text="formatRupiah(calculateBase('{{ $key }}'))"></span></span>
                                                <span x-show="hostingVps.{{ $key }}.custom_price"
                                                    class="text-green-600 font-bold">Custom Aktif</span>
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika ingin menggunakan harga
                                            otomatis (Harga Dasar x Durasi).</p>
                                    </div>

                                    <div class="md:col-span-12 h-px bg-gray-200 my-1"></div>

                                    {{-- 2. Pilihan Tipe Promo --}}
                                    <div class="md:col-span-3">
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe
                                            Promo</label>
                                        <select name="discount_config[{{ $key }}][type]"
                                            x-model="hostingVps.{{ $key }}.type"
                                            class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500">
                                            <option value="none">Normal (Tidak Ada)</option>
                                            <option value="percent">Diskon Persen (%)</option>
                                            <option value="fixed">Harga Spesial (Rp)</option>
                                        </select>
                                    </div>

                                    {{-- 3. Input Nilai (Hidden if None) --}}
                                    <div class="md:col-span-3" x-show="hostingVps.{{ $key }}.type !== 'none'"
                                        x-transition>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                                            <span
                                                x-text="hostingVps.{{ $key }}.type === 'percent' ? 'Besar Diskon (%)' : 'Harga Promo (Rp)'"></span>
                                        </label>
                                        <input type="number" name="discount_config[{{ $key }}][value]"
                                            x-model="hostingVps.{{ $key }}.value"
                                            class="w-full text-sm font-bold border-blue-300 rounded-lg focus:ring-blue-500 text-blue-700"
                                            placeholder="0">
                                    </div>

                                    {{-- 4. Label Acara (Hidden if None) --}}
                                    <div class="md:col-span-4" x-show="hostingVps.{{ $key }}.type !== 'none'"
                                        x-transition>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Acara /
                                            Label</label>
                                        <input type="text" name="discount_config[{{ $key }}][label]"
                                            x-model="hostingVps.{{ $key }}.label"
                                            class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500"
                                            placeholder="Cth: Flash Sale / Off 1st Year">
                                    </div>

                                    {{-- 5. Preview Hemat --}}
                                    <div class="md:col-span-2 text-right"
                                        x-show="hostingVps.{{ $key }}.type !== 'none'" x-transition>
                                        <div
                                            class="bg-green-50 px-2 py-1 rounded border border-green-100 inline-block text-center w-full">
                                            <span class="block text-[10px] text-green-600 font-bold uppercase">Hemat</span>
                                            {{-- Note: calculatePromoSave now takes the CUSTOM or BASE price --}}
                                            <span class="block text-lg font-extrabold text-green-700"
                                                x-text="calculatePromoSave(getCyclePrice('{{ $key }}'), hostingVps.{{ $key }}.type, hostingVps.{{ $key }}.value) + '%'"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Preview Harga Akhir --}}
                                <div class="mt-3 pt-3 border-t border-dashed border-gray-200 flex justify-between items-center"
                                    x-show="hostingVps.{{ $key }}.type !== 'none'" x-transition>
                                    <span class="text-xs text-gray-400 italic">Simulasi Tampilan:</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-400 line-through"
                                            x-text="'Rp ' + formatRupiah(getCyclePrice('{{ $key }}'))"></span>
                                        <span class="text-sm font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded"
                                            x-text="'Rp ' + formatRupiah(calculatePromoPrice(getCyclePrice('{{ $key }}'), hostingVps.{{ $key }}.type, hostingVps.{{ $key }}.value))"></span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- SECTION 3: CONFIG DOMAIN --}}
                <div x-show="type === 'domain'" class="md:col-span-2" x-transition>
                    <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-2 mb-6 flex items-center gap-2">
                        <i class="ri-global-line text-blue-600"></i> Konfigurasi Harga Domain
                    </h3>

                    <div class="space-y-6">
                        {{-- 1. REGISTER --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 relative">
                            <span
                                class="absolute top-0 left-0 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-br-lg uppercase tracking-wider">Register</span>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-blue-800 uppercase mb-1">Harga
                                        Normal</label>
                                    <div
                                        class="w-full bg-blue-100/50 border border-blue-200 rounded-lg px-3 py-2 text-sm font-bold text-blue-900 cursor-not-allowed">
                                        <span x-text="formatRupiah(price)"></span>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Promo</label>
                                    <select name="discount_config[register][type]" x-model="domain.register.type"
                                        class="w-full text-sm border-gray-300 rounded-lg">
                                        <option value="none">Normal</option>
                                        <option value="percent">Diskon (%)</option>
                                        <option value="fixed">Harga Spesial (Rp)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-3" x-show="domain.register.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nilai</label>
                                    <input type="number" name="discount_config[register][value]"
                                        x-model="domain.register.value" class="w-full text-sm border-blue-300 rounded-lg">
                                </div>
                                <div class="md:col-span-4" x-show="domain.register.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Label Acara</label>
                                    <input type="text" name="discount_config[register][label]"
                                        x-model="domain.register.label" class="w-full text-sm border-blue-300 rounded-lg"
                                        placeholder="ex: Off 1st Year">
                                </div>
                            </div>
                        </div>

                        {{-- 2. RENEW --}}
                        <div class="bg-orange-50 border border-orange-200 rounded-xl p-5 relative">
                            <span
                                class="absolute top-0 left-0 bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-br-lg uppercase tracking-wider">Renew</span>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-orange-800 uppercase mb-1">Harga
                                        Normal</label>
                                    <input type="number" name="renew_price" x-model="renewPriceNormal"
                                        class="w-full text-sm font-bold border-orange-200 rounded-lg text-orange-900 bg-white"
                                        placeholder="0">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Promo</label>
                                    <select name="discount_config[renew][type]" x-model="domain.renew.type"
                                        class="w-full text-sm border-gray-300 rounded-lg">
                                        <option value="none">Normal</option>
                                        <option value="percent">Diskon (%)</option>
                                        <option value="fixed">Harga Spesial (Rp)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-3" x-show="domain.renew.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nilai</label>
                                    <input type="number" name="discount_config[renew][value]"
                                        x-model="domain.renew.value" class="w-full text-sm border-orange-300 rounded-lg">
                                </div>
                                <div class="md:col-span-4" x-show="domain.renew.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Label Acara</label>
                                    <input type="text" name="discount_config[renew][label]"
                                        x-model="domain.renew.label" class="w-full text-sm border-orange-300 rounded-lg"
                                        placeholder="ex: Loyalty Deal">
                                </div>
                            </div>
                        </div>

                        {{-- 3. TRANSFER --}}
                        <div class="bg-purple-50 border border-purple-200 rounded-xl p-5 relative">
                            <span
                                class="absolute top-0 left-0 bg-purple-600 text-white text-[10px] font-bold px-3 py-1 rounded-br-lg uppercase tracking-wider">Transfer</span>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-purple-800 uppercase mb-1">Harga
                                        Normal</label>
                                    <input type="number" name="transfer_price" x-model="transferPriceNormal"
                                        class="w-full text-sm font-bold border-purple-200 rounded-lg text-purple-900 bg-white"
                                        placeholder="0">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipe Promo</label>
                                    <select name="discount_config[transfer][type]" x-model="domain.transfer.type"
                                        class="w-full text-sm border-gray-300 rounded-lg">
                                        <option value="none">Normal</option>
                                        <option value="percent">Diskon (%)</option>
                                        <option value="fixed">Harga Spesial (Rp)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-3" x-show="domain.transfer.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nilai</label>
                                    <input type="number" name="discount_config[transfer][value]"
                                        x-model="domain.transfer.value"
                                        class="w-full text-sm border-purple-300 rounded-lg">
                                </div>
                                <div class="md:col-span-4" x-show="domain.transfer.type !== 'none'">
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Label Acara</label>
                                    <input type="text" name="discount_config[transfer][label]"
                                        x-model="domain.transfer.label"
                                        class="w-full text-sm border-purple-300 rounded-lg"
                                        placeholder="ex: Free Transfer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6 mt-6">
                <label class="block text-sm font-bold text-gray-700 mb-3">Fitur Produk (List Checklist)</label>

                {{-- Alpine Data: Jika Edit ambil data dari DB, jika Baru mulai dengan 1 input kosong --}}
                <div x-data="{
                    features: {{ isset($product) && $product->features->count() > 0 ? $product->features->pluck('feature_text') : '[\'\']' }}
                }">

                    {{-- Loop Input Fitur --}}
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="flex gap-2 mb-2 items-center">
                            <span class="text-gray-400 text-sm"><i class="ri-checkbox-circle-line"></i></span>

                            {{-- Input Text --}}
                            <input type="text" name="features[]" x-model="features[index]"
                                class="flex-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Contoh: 2 CPU Cores atau Gratis SSL">

                            {{-- Tombol Hapus Baris --}}
                            <button type="button" @click="features.splice(index, 1)"
                                class="text-red-500 hover:bg-red-50 p-2 rounded border border-red-200 transition"
                                x-show="features.length > 1">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </template>

                    {{-- Tombol Tambah Baris --}}
                    <button type="button" @click="features.push('')"
                        class="mt-2 text-sm text-blue-600 font-semibold hover:underline flex items-center gap-1">
                        <i class="ri-add-circle-line"></i> Tambah Baris Fitur
                    </button>
                </div>

                <p class="text-[10px] text-gray-400 mt-2">*List ini akan muncul sebagai checklist di kartu harga.</p>
            </div>

            <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.products.index') }}"
                    class="px-5 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold transition hover:bg-gray-50">Batal</a>
                <button type="button" @click="submitForm()" :disabled="isLoading"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold shadow-lg transition disabled:opacity-50 flex items-center gap-2">
                    <span x-show="isLoading" class="animate-spin"><i class="ri-loader-4-line"></i></span>
                    <span>Simpan Produk</span>
                </button>
            </div>

        </form>
    </div>

    <script>
        function productHandler() {
            return {
                type: '{{ old('type', request('type', $product->type ?? 'domain')) }}',
                price: {{ old('price', $product->price ?? 0) }},
                isLoading: false,

                // Data dari DB (JSON)
                dbDiscounts: @json($product->discount_config ?? []),

                // Struktur Model Hosting/VPS (Updated with custom_price)
                hostingVps: {
                    monthly: {
                        type: 'none',
                        value: 0,
                        label: '',
                        custom_price: ''
                    },
                    quarterly: {
                        type: 'none',
                        value: 0,
                        label: '',
                        custom_price: ''
                    },
                    annually: {
                        type: 'none',
                        value: 0,
                        label: '',
                        custom_price: ''
                    },
                    biennially: {
                        type: 'none',
                        value: 0,
                        label: '',
                        custom_price: ''
                    }
                },

                // Struktur Model Domain
                domain: {
                    register: {
                        type: 'none',
                        value: 0,
                        label: ''
                    },
                    renew: {
                        type: 'none',
                        value: 0,
                        label: ''
                    },
                    transfer: {
                        type: 'none',
                        value: 0,
                        label: ''
                    }
                },

                renewPriceNormal: {{ old('renew_price', $product->renew_price ?? 0) }},
                transferPriceNormal: {{ old('transfer_price', $product->transfer_price ?? 0) }},

                initData() {
                    if (this.dbDiscounts) {
                        if (this.type === 'domain') {
                            ['register', 'renew', 'transfer'].forEach(key => {
                                if (this.dbDiscounts[key]) {
                                    this.domain[key].type = this.dbDiscounts[key].type || 'none';
                                    this.domain[key].value = this.dbDiscounts[key].value || 0;
                                    this.domain[key].label = this.dbDiscounts[key].label || '';
                                }
                            });
                        } else {
                            // Populate Hosting/VPS (Termasuk custom_price)
                            ['monthly', 'quarterly', 'annually', 'biennially'].forEach(key => {
                                if (this.dbDiscounts[key]) {
                                    this.hostingVps[key].type = this.dbDiscounts[key].type || 'none';
                                    this.hostingVps[key].value = this.dbDiscounts[key].value || 0;
                                    this.hostingVps[key].label = this.dbDiscounts[key].label || '';
                                    this.hostingVps[key].custom_price = this.dbDiscounts[key].custom_price || '';
                                }
                            });
                        }
                    }
                },

                // Hitung Harga Dasar Otomatis (Jika custom_price kosong)
                calculateBase(cycle) {
                    let multiplier = 1;
                    if (cycle === 'quarterly') multiplier = 3;
                    if (cycle === 'annually') multiplier = 12;
                    if (cycle === 'biennially') multiplier = 24;
                    return this.price * multiplier;
                },

                // Helper: Ambil Harga Acuan (Custom Price ATAU Base Price Auto)
                getCyclePrice(cycle) {
                    let custom = parseFloat(this.hostingVps[cycle].custom_price);
                    if (custom > 0) return custom;
                    return this.calculateBase(cycle);
                },

                // Helper: Hitung Harga Setelah Diskon
                calculatePromoPrice(normal, type, value) {
                    normal = Number(normal);
                    value = Number(value);
                    if (type === 'percent' && value > 0) {
                        let discountAmount = normal * (value / 100);
                        return Math.round(normal - discountAmount);
                    } else if (type === 'fixed' && value > 0) {
                        return value;
                    }
                    return normal;
                },

                // Helper: Hitung % Hemat
                calculatePromoSave(normal, type, value) {
                    normal = Number(normal);
                    value = Number(value);
                    let finalPrice = this.calculatePromoPrice(normal, type, value);
                    if (normal > 0 && finalPrice < normal) {
                        return Math.round(((normal - finalPrice) / normal) * 100);
                    }
                    return 0;
                },

                formatRupiah(num) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(num);
                },

                submitForm() {
                    this.isLoading = true;
                    const form = document.getElementById('productForm');
                    const formData = new FormData(form);
                    const url =
                        '{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}';
                    @if (isset($product))
                        formData.append('_method', 'PUT');
                    @endif

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.isLoading = false;
                            if (data.status === 'success') {
                                Swal.fire('Berhasil', data.message, 'success').then(() => window.location.href = data
                                    .redirect);
                            } else {
                                let msg = data.errors ? Object.values(data.errors).flat().join('\n') :
                                    'Gagal menyimpan data';
                                Swal.fire('Gagal', msg, 'error');
                            }
                        })
                        .catch(err => {
                            this.isLoading = false;
                            console.error(err);
                            Swal.fire('Error', 'Terjadi kesalahan server', 'error');
                        });
                }
            }
        }
    </script>
@endsection
