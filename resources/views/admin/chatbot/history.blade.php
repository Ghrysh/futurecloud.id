@extends('layouts.admin-app')
@section('title', 'Chat History')
@section('header_title', 'Riwayat Percakapan User')

@section('content')
<div x-data="historyViewer()" x-cloak class="mx-4 sm:mx-0">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Table Header -->
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800 text-sm sm:text-base">Log Aktivitas Chat</h3>
                <p class="text-[10px] sm:text-xs text-gray-500">Memantau interaksi user dengan FutureBot</p>
            </div>
        </div>
    
        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[600px] sm:min-w-full">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold whitespace-nowrap">Waktu Mulai</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold">User</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 font-bold">Pesan Terakhir</th>
                        {{-- Hide 'Total Pesan' on mobile --}}
                        <th class="hidden sm:table-cell px-6 py-3 font-bold text-center">Total Pesan</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($sessions as $session)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-gray-500 whitespace-nowrap">
                            <span class="block text-xs sm:text-sm">{{ $session->created_at->format('d M Y, H:i') }}</span>
                            <span class="text-[10px]">{{ $session->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <div class="font-bold text-gray-800 text-xs sm:text-sm">{{ $session->user_name }}</div>
                            <div class="text-[10px] sm:text-xs text-gray-400">ID: {{ substr($session->session_id, 0, 8) }}...</div>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-gray-500 truncate max-w-[150px] sm:max-w-xs text-xs sm:text-sm">
                            {{ $session->messages->last()->message ?? '-' }}
                        </td>
                        {{-- Hide on mobile --}}
                        <td class="hidden sm:table-cell px-6 py-4 text-center">
                            <span class="bg-gray-100 text-gray-600 py-1 px-2.5 rounded-full text-xs font-bold">
                                {{ $session->messages->count() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                            <button @click='openChatModal(@json($session->messages), "{{ $session->user_name }}")'
                                    class="inline-flex items-center gap-1 text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 px-2 py-1.5 sm:px-3 sm:py-1.5 rounded-lg text-[10px] sm:text-xs font-bold transition whitespace-nowrap">
                                <i class="ri-eye-line"></i> <span class="hidden sm:inline">Lihat Chat</span><span class="sm:hidden">Lihat</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada riwayat percakapan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- MODAL CHAT HISTORY -->
    <div x-show="isOpen" style="display: none;" 
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-transition.opacity>
        
        <div @click.outside="closeModal()" 
             class="bg-white w-full max-w-md h-[80vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden m-4 sm:m-0"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <!-- Header Modal -->
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
    
            <!-- Chat Content Area -->
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50 space-y-4">
                <template x-for="msg in activeMessages">
                    <div :class="msg.sender === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div class="max-w-[85%] sm:max-w-[80%]">
                            <!-- Label Nama & Jam -->
                            <div class="flex items-center gap-2 mb-1" :class="msg.sender === 'user' ? 'justify-end' : 'justify-start'">
                                <span class="text-[10px] font-bold text-gray-500" 
                                      x-text="msg.sender === 'user' ? activeUser : 'FutureBot'"></span>
                                <span class="text-[10px] text-gray-400" x-text="formatTime(msg.created_at)"></span>
                            </div>
    
                            <!-- Bubble -->
                            <div :class="msg.sender === 'user' 
                                ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm shadow-md' 
                                : 'bg-white text-gray-800 border border-gray-200 rounded-2xl rounded-tl-none px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm shadow-sm'"
                                x-html="msg.message">
                            </div>
                        </div>
                    </div>
                </template>
                
                <div x-show="activeMessages.length === 0" class="text-center text-gray-400 mt-10">
                    <p class="text-sm">Tidak ada pesan dalam sesi ini.</p>
                </div>
            </div>
    
            <!-- Footer -->
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
            activeMessages: [],
            activeUser: '',

            openChatModal(messages, userName) {
                this.activeMessages = messages;
                this.activeUser = userName;
                this.isOpen = true;
            },

            closeModal() {
                this.isOpen = false;
                this.activeMessages = [];
            },

            formatTime(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
        }
    }
</script>
<style>[x-cloak] { display: none !important; }</style>
@endsection