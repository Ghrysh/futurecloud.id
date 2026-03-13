@extends('layouts.admin-app')

@section('title', 'Review Partner')
@section('header_title', 'Tinjau Permintaan Partner')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        
        {{-- Breadcrumb --}}
        <div>
            <a href="{{ route('admin.partners.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 transition font-medium">
                <i class="ri-arrow-left-line"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            
            {{-- KOLOM KIRI: DATA DETAIL --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Data Perusahaan --}}
                <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                            <i class="ri-building-4-line"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Profil Perusahaan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Perusahaan --}}
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Perusahaan</label>
                            <p class="text-gray-900 font-semibold text-base">{{ $partner->company_name }}</p>
                        </div>

                        {{-- No Telepon --}}
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Nomor Telepon</label>
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="ri-phone-line text-blue-500"></i>
                                <span class="font-medium">{{ $partner->phone_number }}</span>
                            </div>
                        </div>

                        {{-- Alamat (Full Width) --}}
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Alamat Lengkap</label>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 text-gray-700 text-sm leading-relaxed flex items-start gap-3">
                                <i class="ri-map-pin-line text-red-500 mt-0.5 shrink-0"></i>
                                {{ $partner->address }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Pemohon --}}
                <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                            <i class="ri-user-star-line"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Informasi Pemohon</h3>
                    </div>

                    <div class="flex items-center gap-4 bg-purple-50/50 p-4 rounded-xl border border-purple-50">
                        <div class="w-12 h-12 rounded-full bg-white text-gray-500 flex items-center justify-center text-lg font-bold border border-gray-200 shadow-sm">
                            {{ substr($partner->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $partner->name }}</p>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="ri-mail-line"></i> {{ $partner->email }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: ACTION PANEL --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-lg sticky top-6">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Tindakan Admin</h3>
                    
                    <div class="space-y-3">
                        <div class="bg-yellow-50 text-yellow-800 p-3 rounded-lg text-xs mb-4 border border-yellow-100">
                            <i class="ri-error-warning-fill mr-1 align-bottom"></i> 
                            Pastikan data perusahaan valid sebelum menyetujui.
                        </div>

                        {{-- Tombol Approve --}}
                        <button onclick="confirmApprove('{{ $partner->id }}', '{{ $partner->company_name }}')" 
                                class="w-full py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition flex items-center justify-center gap-2 shadow-md shadow-green-100 group">
                            <i class="ri-checkbox-circle-line text-lg group-hover:scale-110 transition-transform"></i> 
                            Approve Partner
                        </button>

                        {{-- Tombol Reject --}}
                        <button onclick="openRejectModal()" 
                                class="w-full py-3 bg-white border-2 border-red-100 text-red-500 rounded-lg font-bold hover:bg-red-50 hover:border-red-200 transition flex items-center justify-center gap-2">
                            <i class="ri-close-circle-line text-lg"></i> 
                            Tolak Permintaan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- FORM HIDDEN --}}
    <form id="approve-form" method="POST" style="display: none;">@csrf</form>
    <form id="reject-form" method="POST" style="display: none;">@csrf <input type="hidden" name="reason" id="reject-reason-input"></form>

    <script>
        // Logic SweetAlert Approve
        function confirmApprove(id, name) {
            Swal.fire({
                title: 'Setujui Partner?',
                text: "Anda akan menyetujui '" + name + "' sebagai partner resmi.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('approve-form');
                    form.action = "/admin/partners/" + id + "/approve";
                    form.submit();
                }
            });
        }

        // Logic SweetAlert Reject dengan Input Alasan
        function openRejectModal() {
            Swal.fire({
                title: 'Tolak Permintaan',
                text: "Masukkan alasan penolakan untuk dikirim ke email pemohon.",
                input: 'textarea',
                inputPlaceholder: 'Contoh: Data perusahaan tidak valid...',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Tolak & Kirim',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) return 'Wajib menyertakan alasan penolakan!';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('reject-form');
                    document.getElementById('reject-reason-input').value = result.value;
                    form.action = "/admin/partners/{{ $partner->id }}/reject";
                    form.submit();
                }
            });
        }
    </script>
@endsection