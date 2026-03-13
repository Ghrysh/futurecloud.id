@extends('layouts.admin-app')

@section('title', 'Kelola Portfolio')
@section('header_title', 'Kelola Portfolio')

@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- Header & Button Add --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Project</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola portofolio yang tampil di halaman depan.</p>
        </div>
        <a href="{{ route('admin.portfolios.create') }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="ri-add-line text-lg"></i> Tambah Project
        </a>
    </div>

    {{-- Table Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Thumbnail</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul & Link</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($portfolios as $item)
                    <tr class="hover:bg-gray-50/50 transition duration-150">
                        
                        {{-- Image --}}
                        <td class="px-6 py-4 align-middle">
                            <div class="h-16 w-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative group">
                                <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-cover" alt="Portfolio Image">
                            </div>
                        </td>

                        {{-- Title & URL --}}
                        <td class="px-6 py-4 align-middle">
                            <div class="font-bold text-gray-800 text-base">{{ $item->title }}</div>
                            @if($item->url)
                                <a href="{{ $item->url }}" target="_blank" class="text-xs text-blue-500 hover:text-blue-700 hover:underline flex items-center gap-1 mt-1 font-medium w-fit">
                                    <i class="ri-link"></i> {{ Str::limit($item->url, 30) }} <i class="ri-external-link-line text-[10px]"></i>
                                </a>
                            @else
                                <span class="text-xs text-gray-400 mt-1 flex items-center gap-1"><i class="ri-link-unlink"></i> Tidak ada link</span>
                            @endif
                        </td>

                        {{-- Category --}}
                        <td class="px-6 py-4 align-middle">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                                {{ $item->category }}
                            </span>
                        </td>

                        {{-- Actions Buttons --}}
                        <td class="px-6 py-4 align-middle text-right">
                            <div class="flex items-center justify-end gap-2">
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.portfolios.edit', $item->id) }}"
                                   class="group p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white border border-yellow-200 transition-all duration-200 shadow-sm"
                                   title="Edit Data">
                                    <i class="ri-edit-line text-lg"></i>
                                </a>

                                {{-- Tombol Delete (Trigger Modal) --}}
                                <button onclick="confirmDelete('{{ $item->id }}', '{{ $item->title }}')"
                                        class="group p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-500 hover:text-white border border-red-200 transition-all duration-200 shadow-sm"
                                        title="Hapus Data">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>

                                {{-- Form Delete (Hidden) --}}
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.portfolios.destroy', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="ri-folder-open-line text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-gray-900 font-medium">Belum ada portfolio</h3>
                                <p class="text-gray-500 text-sm mt-1">Mulai tambahkan project pertama Anda sekarang.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($portfolios->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $portfolios->links() }}
        </div>
        @endif
    </div>
</div>

{{-- SCRIPT: SweetAlert2 Confirmation --}}
<script>
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Hapus Project?',
            text: "Anda akan menghapus portfolio '" + title + "'. Data tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444', // Red 500
            cancelButtonColor: '#6B7280', // Gray 500
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true, // Tombol hapus di kanan (lebih aman dari salah klik)
            width: '400px',
            customClass: {
                popup: 'rounded-xl font-inter',
                title: 'text-xl font-bold text-gray-800',
                htmlContainer: 'text-sm text-gray-500',
                confirmButton: 'px-5 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-red-500/30',
                cancelButton: 'px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-200'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form jika user klik Ya
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection