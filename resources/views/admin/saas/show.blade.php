@extends('layouts.admin-app')

@section('title', 'Review Aplikasi')
@section('header_title', 'Review Aplikasi')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        
        {{-- Breadcrumb / Back Button --}}
        <div>
            <a href="{{ route('admin.saas.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 transition font-medium">
                <i class="ri-arrow-left-line"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            
            {{-- KOLOM KIRI: DETAIL APLIKASI --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Hero Image & Header --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-2">
                        @php
                            $imgSrc = $app->thumbnail;
                            if (!Str::startsWith($imgSrc, 'http')) {
                                $imgSrc = asset('storage/' . $imgSrc);
                            }
                        @endphp
                        <img src="{{ $imgSrc }}" class="w-full h-48 md:h-80 object-cover rounded-lg border border-gray-100">
                    </div>
                    
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $app->name }}</h1>
                                <p class="text-gray-500 mt-1 text-sm md:text-base">{{ $app->tagline }}</p>
                            </div>
                            <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold border border-blue-100 w-fit h-fit">
                                <i class="ri-price-tag-3-line"></i> {{ $app->category }}
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">Harga Langganan</span>
                                <span class="text-lg md:text-xl font-bold text-blue-600">Rp {{ number_format($app->price) }}</span>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">Partner</span>
                                <div class="flex items-center gap-2">
                                    <i class="ri-user-smile-line text-gray-500"></i>
                                    <span class="text-sm font-semibold text-gray-700 truncate">{{ $app->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
                        <i class="ri-file-text-line text-gray-400"></i> Deskripsi Aplikasi
                    </h3>
                    <div class="prose max-w-none text-sm md:text-base text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $app->description }}
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: ACTION PANEL (Sticky di Desktop) --}}
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    
                    {{-- Status Card --}}
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <h3 class="font-bold text-gray-900 mb-4 text-sm">Status Aplikasi</h3>
                        
                        <div class="p-4 rounded-xl text-center border-2 
                            {{ $app->status == 'approved' ? 'bg-green-50 border-green-200 text-green-700' : 
                              ($app->status == 'rejected' ? 'bg-red-50 border-red-200 text-red-700' : 'bg-yellow-50 border-yellow-200 text-yellow-700') }}">
                            
                            <div class="text-3xl mb-1">
                                @if($app->status == 'approved') <i class="ri-checkbox-circle-fill"></i>
                                @elseif($app->status == 'rejected') <i class="ri-close-circle-fill"></i>
                                @else <i class="ri-time-fill"></i>
                                @endif
                            </div>
                            <span class="text-lg font-bold capitalize">{{ $app->status }}</span>
                            @if($app->status == 'pending')
                                <p class="text-xs opacity-75 mt-1">Menunggu review admin</p>
                            @endif
                        </div>
                    </div>

                    {{-- Actions Card --}}
                    @if($app->status == 'pending')
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-lg relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                        
                        <h3 class="font-bold text-gray-900 mb-4 text-sm">Tindakan Admin</h3>
                        <div class="space-y-3">
                            <button onclick="confirmApprove('{{ $app->id }}', '{{ $app->name }}')" 
                                    class="w-full py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-md shadow-green-200 flex items-center justify-center gap-2 group">
                                <i class="ri-check-double-line text-xl group-hover:scale-110 transition-transform"></i> Setujui & Publish
                            </button>

                            <button onclick="openRejectModal()" 
                                    class="w-full py-3 bg-white border-2 border-red-100 text-red-500 rounded-lg font-bold hover:bg-red-50 hover:border-red-200 transition flex items-center justify-center gap-2">
                                <i class="ri-close-circle-line text-xl"></i> Tolak Aplikasi
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-4 text-center leading-tight">
                            Pastikan aplikasi telah memenuhi syarat & ketentuan sebelum menyetujui.
                        </p>
                    </div>
                    @else
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 text-center">
                        <p class="text-sm text-gray-500">Tindakan sudah diambil pada:</p>
                        <p class="font-mono text-xs font-bold text-gray-700 mt-1">{{ $app->updated_at->format('d M Y H:i') }}</p>
                        
                        @if($app->status != 'rejected')
                        <button onclick="openRejectModal()" class="mt-4 text-xs text-red-500 hover:underline">
                            Batalkan & Hapus (Tolak)
                        </button>
                        @endif
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    {{-- Form Hidden (Tetap sama) --}}
    <form id="approve-form" method="POST" style="display: none;">@csrf</form>
    <form id="reject-form" method="POST" style="display: none;">@csrf <input type="hidden" name="reason" id="reject-reason-input"></form>

    <script>
        function confirmApprove(id, name) {
            Swal.fire({
                title: 'Setujui Aplikasi?',
                text: "Aplikasi '" + name + "' akan live di marketplace.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Publish!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('approve-form');
                    form.action = "/admin/saas/" + id + "/approve";
                    form.submit();
                }
            });
        }

        function openRejectModal() {
            Swal.fire({
                title: 'Tolak Aplikasi',
                text: "Berikan alasan penolakan untuk partner.",
                input: 'textarea',
                inputPlaceholder: 'Alasan penolakan...',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Tolak',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) return 'Wajib isi alasan!';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('reject-form');
                    document.getElementById('reject-reason-input').value = result.value;
                    form.action = "/admin/saas/{{ $app->id }}/reject";
                    form.submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection