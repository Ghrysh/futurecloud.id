@extends('layouts.admin-app')
@section('title', 'Leads & Chat History')
@section('header_title', 'Riwayat Chat & Leads')

@section('content')
<div x-data="historyViewer()" x-cloak class="mx-4 sm:mx-0">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800 text-sm sm:text-base">Daftar Leads & Log Chat</h3>
                <p class="text-[10px] sm:text-xs text-gray-500">Memantau user yang butuh follow up dari FutureBot</p>
            </div>
        </div>
    
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[700px] sm:min-w-full">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold whitespace-nowrap">Waktu Mulai</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold">Kontak / IP</th>
                        <th class="hidden sm:table-cell px-4 py-3 sm:px-6 sm:py-3 font-bold">Topik Terakhir</th>
                        <th class="hidden md:table-cell px-4 py-3 sm:px-6 sm:py-3 font-bold">Pesan Terakhir</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold text-center">Status</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($leads as $lead)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-gray-500 whitespace-nowrap">
                            <span class="block text-xs sm:text-sm">{{ $lead->created_at->format('d M Y, H:i') }}</span>
                            <span class="text-[10px]">{{ $lead->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <div class="font-bold text-gray-800 text-xs sm:text-sm">{{ $lead->contact_info ?: 'Anonim' }}</div>
                            <div class="text-[10px] sm:text-xs text-gray-400">IP: {{ $lead->ip_address }}</div>
                        </td>
                        <td class="hidden sm:table-cell px-4 py-3 sm:px-6 sm:py-4 text-gray-500 text-xs sm:text-sm">
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $lead->topic_context ?? 'Umum' }}</span>
                        </td>
                        <td class="hidden md:table-cell px-4 py-3 sm:px-6 sm:py-4 text-gray-500 truncate max-w-[150px] text-xs sm:text-sm">
                            {{ $lead->last_message ?? '-' }}
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-center">
                            <form action="{{ route('admin.chatbot.lead.status', $lead->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                    class="px-2.5 py-1 rounded-full text-[10px] sm:text-xs font-bold transition {{ $lead->status === 'contacted' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-orange-100 text-orange-700 hover:bg-orange-200' }}">
                                    {{ $lead->status === 'contacted' ? 'Sudah Dihubungi' : 'Pending' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                            <button @click="fetchChatHistory({{ $lead->id }}, '{{ addslashes($lead->contact_info ?: $lead->ip_address) }}')"
                                    class="inline-flex items-center gap-1 text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 px-2 py-1.5 sm:px-3 sm:py-1.5 rounded-lg text-[10px] sm:text-xs font-bold transition whitespace-nowrap">
                                <i class="ri-eye-line"></i> <span class="hidden sm:inline">Lihat Chat</span><span class="sm:hidden">Lihat</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada riwayat leads atau percakapan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div x-show="isOpen" style="display: none;" 
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-transition.opacity>
        
        <div @click.outside="closeModal()" 
             class="bg-white w-full max-w-md h-[80vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden m-4 sm:m-0"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="bg-blue-600 p-4 flex justify-between items-center text-white shadow-md z-10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="ri-user-smile-line text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm" x-text="activeUser"></h3>
                        <p class="text-[10px] sm:text-xs opacity-80">Riwayat Percakapan</p>
                    </div>
                </div>
                <button @click="closeModal()" class="hover:bg-white/20 p-2 rounded-full transition"><i class="ri-close-line text-xl"></i></button>
            </div>
    
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50 space-y-4">
                
                <div x-show="isLoading" class="flex justify-center items-center h-full">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>

                <template x-if="!isLoading">
                    <div>
                        <template x-for="(msg, index) in activeMessages" :key="index">
                            <div :class="msg.sender === 'user' ? 'flex justify-end mb-4' : 'flex justify-start mb-4'">
                                <div class="max-w-[85%] sm:max-w-[80%]">
                                    <div class="flex items-center gap-2 mb-1" :class="msg.sender === 'user' ? 'justify-end' : 'justify-start'">
                                        <span class="text-[10px] font-bold text-gray-500" 
                                            x-text="msg.sender === 'user' ? activeUser : 'FutureBot'"></span>
                                    </div>
            
                                    <div :class="msg.sender === 'user' 
                                        ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm shadow-md' 
                                        : 'bg-white text-gray-800 border border-gray-200 rounded-2xl rounded-tl-none px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm shadow-sm'"
                                        x-html="msg.text">
                                    </div>
                                </div>
                            </div>
                        </template>
                        
                        <div x-show="activeMessages.length === 0" class="text-center text-gray-400 mt-10">
                            <p class="text-sm">Tidak ada log pesan dalam sesi ini.</p>
                        </div>
                    </div>
                </template>
            </div>
    
            <div class="p-3 bg-white border-t border-gray-100 text-center">
                <button @click="closeModal()" class="text-gray-500 text-xs hover:text-gray-800 font-bold">Tutup Jendela</button>
            </div>
        </div>
    </div>
</div>

<script>
    function historyViewer() {
        return {
            isOpen: false,
            isLoading: false,
            activeMessages: [],
            activeUser: '',

            async fetchChatHistory(leadId, userName) {
                this.activeUser = userName;
                this.isOpen = true;
                this.isLoading = true;
                this.activeMessages = [];
                
                try {
                    let res = await fetch(`/admin/chatbot/leads/${leadId}/history`);
                    let data = await res.json();
                    this.activeMessages = data.history || [];
                } catch (e) {
                    console.error('Gagal memuat riwayat', e);
                    alert('Gagal memuat riwayat chat. Coba lagi.');
                } finally {
                    this.isLoading = false;
                }
            },

            closeModal() {
                this.isOpen = false;
                setTimeout(() => {
                    this.activeMessages = [];
                }, 300);
            }
        }
    }
</script>
<style>[x-cloak] { display: none !important; }</style>
@endsection