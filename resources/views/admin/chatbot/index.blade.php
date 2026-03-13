@extends('layouts.admin-app')
@section('title', 'Bot Knowledge Base')
@section('header_title', 'Kelola Jawaban Chatbot')

@section('content')
{{-- Added x-cloak to prevent Alpine flash --}}
<style>[x-cloak] { display: none !important; }</style>

{{-- Added px-4 sm:px-6 for container padding --}}
<div x-data="botManager()" x-cloak class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-4 sm:px-6">
    
    <!-- Form Tambah (Kiri) -->
    {{-- Changed sticky to lg:sticky --}}
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100 h-fit lg:sticky lg:top-6 order-2 lg:order-1">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-sm sm:text-base">
            <i class="ri-add-circle-line text-blue-600"></i> Tambah Respon Baru
        </h3>
        <form action="{{ route('admin.chatbot.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kata Kunci</label>
                <input type="text" name="keyword" placeholder="Contoh: harga, login, vps" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                <p class="text-[10px] text-gray-400 mt-1">Pisahkan dengan koma jika lebih dari satu.</p>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jawaban Bot</label>
                <textarea name="answer" rows="5" placeholder="Tulis jawaban..." required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"></textarea>
                <p class="text-[10px] text-gray-400 mt-1">Bisa menggunakan HTML dasar (b, i, a).</p>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 text-sm sm:text-base">
                Simpan Respon
            </button>
        </form>
    </div>

    <!-- Tabel List (Kanan) -->
    {{-- Order 1 on mobile to show list first, or keep 2 to show form first. Kept default order mostly, but ensure order-1 for top section if needed. Currently: Form is below on mobile? Standard grid puts Left col on top. --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col order-1 lg:order-2">
        <div class="p-4 sm:p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-sm sm:text-base">Daftar Pengetahuan Bot</h3>
            <span class="bg-blue-100 text-blue-700 text-[10px] sm:text-xs px-2 py-1 rounded-md font-bold">{{ count($responses) }} Items</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[500px] sm:min-w-full">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        {{-- Adjusted padding for mobile --}}
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold">Keyword</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold">Jawaban</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($responses as $res)
                    <tr class="hover:bg-blue-50/50 transition">
                        <td class="px-4 py-3 sm:px-6 sm:py-4 align-top w-1/4">
                            <span class="font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded text-[10px] sm:text-xs leading-relaxed inline-block break-words max-w-[120px] sm:max-w-none">
                                {{ $res->keyword }}
                            </span>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-gray-600 align-top text-xs leading-relaxed max-w-md">
                            {{ Str::limit($res->answer, 100) }}
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-right align-top whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Tombol Edit -->
                                <button @click="openEditModal({{ $res }})" 
                                        class="p-1.5 sm:p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                    <i class="ri-pencil-fill text-sm sm:text-base"></i>
                                </button>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.chatbot.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Hapus respon ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-1.5 sm:p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                        <i class="ri-delete-bin-line text-sm sm:text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada data respon.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div x-show="isEditOpen" style="display: none;" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
         x-transition.opacity>
        
        <div @click.outside="isEditOpen = false" 
             class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all m-4"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
            
            <div class="bg-gray-50 px-4 sm:px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-base sm:text-lg">Edit Respon</h3>
                <button @click="isEditOpen = false" class="text-gray-400 hover:text-gray-600"><i class="ri-close-line text-2xl"></i></button>
            </div>

            <form :action="updateUrl" method="POST" class="p-4 sm:p-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kata Kunci</label>
                    <input type="text" name="keyword" x-model="editData.keyword" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jawaban Bot</label>
                    <textarea name="answer" rows="5" x-model="editData.answer" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 focus:ring-2 focus:ring-blue-500 outline-none text-sm"></textarea>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" @click="isEditOpen = false" class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition text-sm">Batal</button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2.5 rounded-lg font-bold hover:bg-blue-700 transition text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function botManager() {
        return {
            isEditOpen: false,
            editData: { keyword: '', answer: '' },
            baseUrl: "{{ route('admin.chatbot.update', '') }}",
            
            get updateUrl() {
                return `${this.baseUrl}/${this.editData.id}`;
            },

            openEditModal(data) {
                this.editData = data;
                this.isEditOpen = true;
            }
        }
    }
</script>
@endsection