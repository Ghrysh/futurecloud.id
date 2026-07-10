@extends('layouts.admin-app')
@section('title', 'Knowledge Base Chatbot')
@section('header_title', 'Kelola Pengetahuan Chatbot')

@section('content')
<div class="mx-4 sm:mx-0 grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
    
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 h-fit order-2 lg:order-1">
        <h3 class="font-bold text-gray-800 text-sm sm:text-base mb-4">Tambah Data Baru</h3>
        <form action="{{ route('admin.chatbot.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] sm:text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Topik (Konteks)</label>
                <input type="text" name="topic" required placeholder="Contoh: Umum, Domain, VPS"
                       class="w-full text-xs sm:text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 sm:p-2.5">
            </div>
            <div>
                <label class="block text-[10px] sm:text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Nama Intent</label>
                <input type="text" name="intent_name" required placeholder="Contoh: tanya_harga_vps"
                       class="w-full text-xs sm:text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 sm:p-2.5">
            </div>
            <div>
                <label class="block text-[10px] sm:text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Keywords (Pisahkan dgn koma)</label>
                <textarea name="keywords" required rows="2" placeholder="Contoh: harga, biaya, pricelist"
                          class="w-full text-xs sm:text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 sm:p-2.5"></textarea>
            </div>
            <div>
                <label class="block text-[10px] sm:text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Jawaban Bot</label>
                <textarea name="response" required rows="4" placeholder="Tulis jawaban bot di sini..."
                          class="w-full text-xs sm:text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 sm:p-2.5"></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm transition">
                Simpan Data
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col order-1 lg:order-2">
        <div class="p-4 sm:p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-sm sm:text-base">Daftar Pengetahuan Bot</h3>
            <span class="bg-blue-100 text-blue-700 text-[10px] sm:text-xs px-2 py-1 rounded-md font-bold">{{ count($knowledges) }} Items</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[600px] sm:min-w-full">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold w-1/4">Topik / Intent</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold w-1/4">Keywords</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold w-1/3">Jawaban</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($knowledges as $knowledge)
                    <tr class="hover:bg-gray-50 transition" x-data="{ editing: false }">
                        <td class="px-4 py-3 sm:px-6 sm:py-4 align-top">
                            <div x-show="!editing">
                                <div class="font-bold text-gray-800 text-xs sm:text-sm">{{ $knowledge->topic }}</div>
                                <div class="text-[10px] sm:text-xs text-gray-400 font-mono">{{ $knowledge->intent_name }}</div>
                            </div>
                            <input x-show="editing" form="edit-form-{{ $knowledge->id }}" type="text" name="topic" value="{{ $knowledge->topic }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700 mb-1">
                            <input x-show="editing" form="edit-form-{{ $knowledge->id }}" type="text" name="intent_name" value="{{ $knowledge->intent_name }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 align-top text-gray-500 text-xs sm:text-sm">
                            <div x-show="!editing" class="flex flex-wrap gap-1">
                                @php
                                    $kwArr = json_decode($knowledge->keywords, true) ?? [];
                                @endphp
                                @foreach($kwArr as $kw)
                                    <span class="bg-gray-100 border border-gray-200 px-1.5 py-0.5 rounded text-[10px]">{{ $kw }}</span>
                                @endforeach
                            </div>
                            <textarea x-show="editing" form="edit-form-{{ $knowledge->id }}" name="keywords" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700" rows="3">{{ implode(', ', $kwArr) }}</textarea>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 align-top text-gray-500 text-xs sm:text-sm">
                            <div x-show="!editing" class="line-clamp-3">{{ $knowledge->response }}</div>
                            <textarea x-show="editing" form="edit-form-{{ $knowledge->id }}" name="response" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700" rows="4">{{ $knowledge->response }}</textarea>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 align-top text-right whitespace-nowrap">
                            
                            <form id="edit-form-{{ $knowledge->id }}" action="{{ route('admin.chatbot.update', $knowledge->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT')
                            </form>

                            <div x-show="!editing" class="flex justify-end gap-2">
                                <button @click="editing = true" class="text-blue-500 hover:text-blue-700 p-1.5 bg-blue-50 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <form action="{{ route('admin.chatbot.destroy', $knowledge->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1.5 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                            <div x-show="editing" class="flex justify-end gap-2 flex-col sm:flex-row" style="display: none;">
                                <button form="edit-form-{{ $knowledge->id }}" type="submit" class="text-white bg-green-500 hover:bg-green-600 px-3 py-1.5 rounded-lg text-xs font-bold transition">Simpan</button>
                                <button @click="editing = false" type="button" class="text-gray-600 bg-gray-200 hover:bg-gray-300 px-3 py-1.5 rounded-lg text-xs font-bold transition">Batal</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data pengetahuan chatbot. Silakan tambahkan di form sebelah kiri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection