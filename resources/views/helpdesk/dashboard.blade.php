<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Dashboard - FutureCloud</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; margin: 0; padding: 0; height: 100vh; overflow: hidden; }
        .bg-wa-header { background-color: #f0f2f5; }
        .bg-wa-body { background-color: #efeae2; background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-size: 412px; }
        .bg-wa-chat-in { background-color: #ffffff; }
        .bg-wa-chat-out { background-color: #d9fdd3; }
        .bg-wa-chat-system { background-color: #fef3c7; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }

        .fade-in { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .slide-up { animation: slideUp 0.3s ease-out; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    
    <div class="flex w-full h-full" x-data="helpdeskApp()" @keydown.escape="closeAllModals()">
        
        {{-- ===================== SIDEBAR KIRI ===================== --}}
        <div class="w-full md:w-[360px] lg:w-[380px] flex flex-col bg-white border-r border-gray-200 z-10 shrink-0">
            {{-- Header Sidebar --}}
            <div class="h-16 bg-wa-header flex items-center justify-between px-4 py-2 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        @if($helpdesk->avatar)
                            <img src="{{ $helpdesk->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <span class="text-white font-bold text-lg">{{ strtoupper(substr($helpdesk->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800 text-sm">{{ $helpdesk->name }}</h2>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <p class="text-[11px] text-gray-500">Online</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('helpdesk.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all" title="Logout">
                        <i class="ri-logout-box-r-line text-lg"></i>
                    </button>
                </form>
            </div>

            {{-- Tabs --}}
            <div class="flex bg-white border-b border-gray-100">
                <button @click="activeTab = 'all'" class="flex-1 py-3 text-[13px] font-semibold border-b-2 transition-colors relative" :class="activeTab === 'all' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                    <i class="ri-message-3-line mr-1"></i> Semua Chat
                    <span x-show="getUnreadRoomCount(allChats) > 0" class="absolute top-2 right-3 bg-blue-500 text-white text-[9px] font-bold w-5 h-5 rounded-full flex items-center justify-center" x-text="getUnreadRoomCount(allChats)"></span>
                </button>
                <button @click="activeTab = 'active'" class="flex-1 py-3 text-[13px] font-semibold border-b-2 transition-colors relative" :class="activeTab === 'active' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                    <i class="ri-chat-check-line mr-1"></i> Ditangani
                    <span x-show="getUnreadRoomCount(activeLeads) > 0" class="absolute top-2 right-3 bg-green-500 text-white text-[9px] font-bold w-5 h-5 rounded-full flex items-center justify-center" x-text="getUnreadRoomCount(activeLeads)"></span>
                </button>
                <button @click="activeTab = 'history'" class="flex-1 py-3 text-[13px] font-semibold border-b-2 transition-colors" :class="activeTab === 'history' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'">
                    <i class="ri-history-line mr-1"></i> Riwayat
                </button>
            </div>

            {{-- Daftar Chat --}}
            <div class="flex-1 overflow-y-auto bg-white">
                
                {{-- Tab: All Chats (Bot + Unhandled) --}}
                <div x-show="activeTab === 'all'">
                    <div x-show="allChats.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <i class="ri-chat-smile-2-line text-5xl mb-3 text-gray-200"></i>
                        <p class="text-sm font-medium text-gray-400">Tidak ada percakapan aktif</p>
                        <p class="text-xs text-gray-300 mt-1">Percakapan baru akan muncul di sini</p>
                    </div>
                    
                    <template x-for="lead in allChats" :key="'all_'+lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-50 cursor-pointer hover:bg-blue-50/50 transition-all" :class="currentChat && currentChat.id === lead.id ? 'bg-blue-50' : ''">
                            <div class="relative shrink-0">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg" :class="lead.helpdesk_id ? 'bg-orange-400' : 'bg-gradient-to-br from-blue-400 to-blue-600'">
                                    <span x-text="getLeadInitial(lead)"></span>
                                </div>
                                <span class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full border-2 border-white flex items-center justify-center text-[8px]" :class="lead.helpdesk_id ? 'bg-orange-500 text-white' : (lead.live_chat_status === 'pending' ? 'bg-yellow-400' : 'bg-green-500')">
                                    <i :class="lead.helpdesk_id ? 'ri-user-line' : (lead.live_chat_status === 'pending' ? 'ri-time-line' : 'ri-robot-line')" class="text-white text-[7px]"></i>
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-0.5">
                                    <h3 class="font-semibold text-gray-800 text-sm truncate" x-text="getLeadName(lead)"></h3>
                                    <div class="flex items-center gap-1.5 shrink-0 ml-2">
                                        <span class="text-[10px] text-gray-400" x-text="getLeadTime(lead)"></span>
                                        <span x-show="getUnreadCount(lead) > 0" class="bg-blue-500 text-white text-[9px] font-bold w-5 h-5 rounded-full flex items-center justify-center" x-text="getUnreadCount(lead)"></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold shrink-0" :class="lead.live_chat_status === 'pending' ? 'bg-yellow-100 text-yellow-700' : (lead.helpdesk_id ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700')" x-text="lead.helpdesk_id ? ('🧑 ' + lead.helpdesk_name) : (lead.live_chat_status === 'pending' ? '⏳ Live Chat Request' : '🤖 Chatbot AI')"></span>
                                </div>
                                <p class="text-xs text-gray-500 truncate mt-0.5" x-text="getLastMessagePreview(lead)"></p>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Tab: Active (Ditangani Saya) --}}
                <div x-show="activeTab === 'active'">
                    <div x-show="activeLeads.length === 0 && activeOthersLeads.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <i class="ri-customer-service-2-line text-5xl mb-3 text-gray-200"></i>
                        <p class="text-sm font-medium text-gray-400">Belum ada obrolan aktif</p>
                        <p class="text-xs text-gray-300 mt-1">Klik "Handle Chat" di tab Semua Chat</p>
                    </div>

                    {{-- Obrolan Saya --}}
                    <div x-show="activeLeads.length > 0" class="px-4 py-2 bg-green-50 border-b border-green-100">
                        <p class="text-[11px] font-bold text-green-700"><i class="ri-checkbox-circle-fill mr-1"></i>Ditangani oleh Anda</p>
                    </div>
                    <template x-for="lead in activeLeads" :key="'my_'+lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-50 cursor-pointer hover:bg-green-50/50 transition-all" :class="currentChat && currentChat.id === lead.id ? 'bg-green-50' : ''">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center text-white font-bold text-lg shrink-0">
                                <span x-text="getLeadInitial(lead)"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-0.5">
                                    <h3 class="font-semibold text-gray-800 text-sm truncate" x-text="getLeadName(lead)"></h3>
                                    <div class="flex items-center gap-1.5 shrink-0 ml-2">
                                        <span class="text-[10px] text-gray-400" x-text="getLeadTime(lead)"></span>
                                        <span x-show="getUnreadCount(lead) > 0" class="bg-green-500 text-white text-[9px] font-bold w-5 h-5 rounded-full flex items-center justify-center" x-text="getUnreadCount(lead)"></span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 truncate" x-text="getLastMessagePreview(lead)"></p>
                            </div>
                        </div>
                    </template>

                    {{-- Obrolan Helpdesk Lain --}}
                    <div x-show="activeOthersLeads.length > 0" class="px-4 py-2 bg-orange-50 border-b border-orange-100 mt-1">
                        <p class="text-[11px] font-bold text-orange-700"><i class="ri-team-line mr-1"></i>Ditangani Helpdesk Lain</p>
                    </div>
                    <template x-for="lead in activeOthersLeads" :key="'other_'+lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-50 cursor-pointer hover:bg-orange-50/30 transition-all opacity-70" :class="currentChat && currentChat.id === lead.id ? 'bg-orange-50 opacity-100' : ''">
                            <div class="w-10 h-10 rounded-full bg-orange-200 flex items-center justify-center text-orange-700 font-bold shrink-0">
                                <span x-text="getLeadInitial(lead)"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-700 text-sm truncate" x-text="getLeadName(lead)"></h3>
                                <p class="text-[10px] text-orange-600 font-semibold truncate"><i class="ri-user-line mr-0.5"></i> <span x-text="lead.helpdesk_name"></span></p>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Tab: History --}}
                <div x-show="activeTab === 'history'">
                    <div x-show="endedLeads.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <i class="ri-archive-line text-5xl mb-3 text-gray-200"></i>
                        <p class="text-sm font-medium text-gray-400">Riwayat obrolan kosong</p>
                    </div>
                    <template x-for="lead in endedLeads" :key="'ended_'+lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-50 cursor-pointer hover:bg-gray-50 transition-all" :class="currentChat && currentChat.id === lead.id ? 'bg-gray-100' : ''">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold shrink-0">
                                <span x-text="getLeadInitial(lead)"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-0.5">
                                    <h3 class="font-medium text-gray-600 text-sm truncate" x-text="getLeadName(lead)"></h3>
                                    <span class="text-[10px] text-gray-400">Selesai</span>
                                </div>
                                <p class="text-[10px] text-gray-500 truncate" x-text="getLastMessagePreview(lead)"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ===================== AREA CHAT KANAN ===================== --}}
        <div class="flex-1 flex flex-col relative hidden md:flex" style="background-color: #efeae2; background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-size: 412px;">
            
            {{-- Welcome Screen --}}
            <div x-show="!currentChat" class="absolute inset-0 z-20 bg-[#f0f2f5] flex flex-col items-center justify-center border-l border-gray-200">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-6 shadow-lg shadow-blue-200">
                    <i class="ri-customer-service-2-fill text-4xl text-white"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-700 mb-2">FutureCloud Helpdesk</h1>
                <p class="text-gray-400 text-sm max-w-md text-center leading-relaxed">Pilih percakapan dari daftar di sebelah kiri untuk melihat riwayat chat dan mulai membantu pelanggan.</p>
                <div class="mt-8 flex items-center gap-2 text-xs text-gray-300">
                    <i class="ri-lock-line"></i>
                    <span>Secured connection</span>
                </div>
            </div>

            {{-- Active Chat Area --}}
            <template x-if="currentChat">
                <div class="flex flex-col h-full w-full">
                    
                    {{-- Chat Header --}}
                    <div class="h-16 bg-[#f0f2f5] flex justify-between items-center px-4 border-l border-b border-gray-200 shadow-sm z-10 shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" :class="currentChat.helpdesk_id == {{ $helpdesk->id }} ? 'bg-gradient-to-br from-green-400 to-emerald-600' : 'bg-gradient-to-br from-blue-400 to-blue-600'">
                                <span x-text="getLeadInitial(currentChat)"></span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm" x-text="getLeadName(currentChat)"></h3>
                                <p class="text-[11px] text-gray-500 flex items-center gap-1.5">
                                    <span x-text="currentChat.ip_address || ''"></span>
                                    <template x-if="currentChat.helpdesk_id && currentChat.live_chat_status === 'active'">
                                        <span class="text-green-600 font-semibold">• Ditangani oleh <span x-text="currentChat.helpdesk_id == {{ $helpdesk->id }} ? 'Anda' : currentChat.helpdesk_name"></span></span>
                                    </template>
                                    <template x-if="!currentChat.helpdesk_id && currentChat.live_chat_status !== 'ended'">
                                        <span class="text-blue-500 font-semibold">• 🤖 Chatbot AI aktif</span>
                                    </template>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            {{-- Handle Chat Button (untuk chat yang belum di-handle) --}}
                            <template x-if="!currentChat.helpdesk_id && currentChat.live_chat_status !== 'ended'">
                                <button @click="showHandleModal = true" class="px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-sm flex items-center gap-1.5">
                                    <i class="ri-hand-heart-line"></i> Handle Chat
                                </button>
                            </template>
                            {{-- End Session Button --}}
                            <template x-if="currentChat.live_chat_status === 'active' && currentChat.helpdesk_id == {{ $helpdesk->id }}">
                                <button @click="showEndModal = true" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-100 border border-red-200 transition-all flex items-center gap-1.5">
                                    <i class="ri-close-circle-line"></i> Akhiri Sesi
                                </button>
                            </template>
                            <template x-if="currentChat.live_chat_status === 'ended'">
                                <span class="px-2.5 py-1 bg-gray-200 text-gray-500 text-xs font-semibold rounded-lg flex items-center gap-1">
                                    <i class="ri-checkbox-circle-line"></i> Selesai
                                </span>
                            </template>
                            {{-- Badge: handled by other --}}
                            <template x-if="currentChat.helpdesk_id && currentChat.helpdesk_id != {{ $helpdesk->id }} && currentChat.live_chat_status === 'active'">
                                <span class="px-2.5 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-lg flex items-center gap-1">
                                    <i class="ri-user-line"></i> <span x-text="currentChat.helpdesk_name"></span>
                                </span>
                            </template>
                        </div>
                    </div>

                    {{-- Chat Messages --}}
                    <div id="chat-messages-container" class="flex-1 overflow-y-auto p-4 sm:p-6 md:px-[8%]">
                        <template x-for="(msg, i) in getChatHistory(currentChat)" :key="i">
                            <div class="mb-2">
                                {{-- System Message --}}
                                <template x-if="msg.sender === 'system'">
                                    <div class="flex justify-center my-3">
                                        <div class="bg-wa-chat-system px-4 py-1.5 rounded-lg shadow-sm max-w-[80%]">
                                            <p class="text-[11px] text-amber-800 text-center" x-text="msg.text"></p>
                                        </div>
                                    </div>
                                </template>

                                {{-- Normal Message --}}
                                <template x-if="msg.sender !== 'system'">
                                    <div class="flex flex-col" :class="isOutgoing(msg) ? 'items-end' : 'items-start'">
                                        <div class="max-w-[80%] sm:max-w-[70%] rounded-lg px-3 py-2 shadow-sm text-sm relative"
                                             :class="isOutgoing(msg) ? 'bg-wa-chat-out rounded-tr-none' : 'bg-wa-chat-in rounded-tl-none'">
                                            
                                            {{-- Sender Label --}}
                                            <div class="text-[11px] font-bold mb-0.5"
                                                 :class="getSenderColor(msg)"
                                                 x-text="getSenderLabel(msg)"></div>

                                            {{-- Message Text --}}
                                            <div class="text-gray-800 leading-relaxed" style="word-wrap: break-word;" x-html="formatMessage(msg.text)"></div>
                                            
                                            {{-- Time --}}
                                            <div class="text-[10px] text-gray-400 text-right mt-1 flex items-center justify-end gap-1">
                                                <span x-text="msg.time || ''"></span>
                                                <template x-if="isOutgoing(msg)">
                                                    <i class="ri-check-double-line text-blue-500"></i>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    {{-- Input Area (Only when I'm handling) --}}
                    <div class="bg-[#f0f2f5] p-3 flex items-center gap-3 w-full shrink-0 relative z-10 border-t border-gray-200" x-show="currentChat.live_chat_status === 'active' && currentChat.helpdesk_id == {{ $helpdesk->id }}">
                        <form @submit.prevent="sendMessage()" class="flex-1 flex gap-2">
                            <input type="text" x-model="inputText" placeholder="Ketik pesan..." class="flex-1 py-2.5 px-4 rounded-lg bg-white border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none text-gray-700 shadow-sm text-sm" autocomplete="off" x-ref="chatInput">
                            <button type="submit" class="w-11 h-11 rounded-full flex items-center justify-center bg-blue-600 text-white hover:bg-blue-700 transition-all shadow-sm" :disabled="!inputText.trim()" :class="inputText.trim() ? '' : 'opacity-50'">
                                <i class="ri-send-plane-fill text-lg"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Not handling info --}}
                    <div class="bg-[#f0f2f5] p-3 text-center w-full shrink-0 z-10 border-t border-gray-200" x-show="currentChat.live_chat_status === 'active' && currentChat.helpdesk_id && currentChat.helpdesk_id != {{ $helpdesk->id }}">
                        <p class="text-gray-500 text-xs flex items-center justify-center gap-1.5">
                            <i class="ri-lock-line"></i> 
                            Chat ini sedang ditangani oleh <strong x-text="currentChat.helpdesk_name"></strong>
                        </p>
                    </div>

                    {{-- Bot is handling / not yet handled --}}
                    <div class="bg-[#f0f2f5] p-3 text-center w-full shrink-0 z-10 border-t border-gray-200" x-show="!currentChat.helpdesk_id && currentChat.live_chat_status !== 'ended'">
                        <div class="flex items-center justify-center gap-3">
                            <p class="text-gray-500 text-xs flex items-center gap-1.5">
                                <i class="ri-robot-line text-blue-500"></i> 
                                Chatbot AI sedang menangani percakapan ini
                            </p>
                            <button @click="showHandleModal = true" class="px-3 py-1.5 bg-blue-600 text-white text-[11px] font-semibold rounded-lg hover:bg-blue-700 transition-all">
                                Handle Chat
                            </button>
                        </div>
                    </div>

                    {{-- Ended chat --}}
                    <div class="bg-[#f0f2f5] p-3 text-center w-full shrink-0 z-10 border-t border-gray-200" x-show="currentChat.live_chat_status === 'ended'">
                        <p class="text-gray-400 text-xs flex items-center justify-center gap-1.5">
                            <i class="ri-checkbox-circle-line"></i> 
                            Sesi percakapan ini telah berakhir
                        </p>
                    </div>

                </div>
            </template>
        </div>

        {{-- ===================== MODAL: Handle Chat ===================== --}}
        <div x-show="showHandleModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
            <div x-show="showHandleModal" x-transition.opacity class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showHandleModal = false"></div>
            <div x-show="showHandleModal" x-transition class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden fade-in">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-hand-heart-fill text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Ambil Alih Percakapan?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-1">Anda akan mengambil alih percakapan ini dari Chatbot AI.</p>
                    <p class="text-gray-400 text-xs">Bot akan mengirim pesan otomatis kepada pelanggan bahwa percakapan diserahkan kepada Anda.</p>
                </div>
                <div class="flex border-t border-gray-100">
                    <button @click="showHandleModal = false" class="flex-1 py-3.5 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-colors border-r border-gray-100">Batal</button>
                    <button @click="claimChat(currentChat.id); showHandleModal = false" class="flex-1 py-3.5 text-sm font-semibold text-blue-600 hover:bg-blue-50 transition-colors">Ya, Handle Chat</button>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: End Session ===================== --}}
        <div x-show="showEndModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
            <div x-show="showEndModal" x-transition.opacity class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showEndModal = false"></div>
            <div x-show="showEndModal" x-transition class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden fade-in">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-close-circle-fill text-3xl text-red-500"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Akhiri Sesi Chat?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Percakapan akan dikembalikan ke Chatbot AI. Pelanggan akan menerima pesan bahwa sesi dengan Anda telah berakhir.</p>
                </div>
                <div class="flex border-t border-gray-100">
                    <button @click="showEndModal = false" class="flex-1 py-3.5 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-colors border-r border-gray-100">Batal</button>
                    <button @click="endChat(currentChat.id); showEndModal = false" class="flex-1 py-3.5 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">Ya, Akhiri</button>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: Error/Alert ===================== --}}
        <div x-show="alertModal.show" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
            <div x-show="alertModal.show" x-transition.opacity class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="alertModal.show = false"></div>
            <div x-show="alertModal.show" x-transition class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden fade-in">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" :class="alertModal.type === 'error' ? 'bg-red-100' : 'bg-green-100'">
                        <i class="text-3xl" :class="alertModal.type === 'error' ? 'ri-error-warning-fill text-red-500' : 'ri-checkbox-circle-fill text-green-500'"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2" x-text="alertModal.title"></h3>
                    <p class="text-gray-500 text-sm" x-text="alertModal.message"></p>
                </div>
                <div class="border-t border-gray-100">
                    <button @click="alertModal.show = false" class="w-full py-3.5 text-sm font-semibold text-blue-600 hover:bg-blue-50 transition-colors">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function helpdeskApp() {
            return {
                activeTab: 'all',
                allChats: [],
                activeLeads: [],
                activeOthersLeads: [],
                endedLeads: [],
                currentChat: null,
                inputText: '',
                pollTimer: null,
                lastPingTime: 0,
                showHandleModal: false,
                showEndModal: false,
                alertModal: { show: false, type: 'info', title: '', message: '' },
                csrf: '{{ csrf_token() }}',
                myId: {{ $helpdesk->id }},

                init() {
                    this.pollData();
                    this.startPolling();
                },

                closeAllModals() {
                    this.showHandleModal = false;
                    this.showEndModal = false;
                    this.alertModal.show = false;
                },

                showAlert(title, message, type = 'error') {
                    this.alertModal = { show: true, type, title, message };
                },

                async pollData() {
                    try {
                        let res = await fetch('/helpdesk/poll');
                        let data = await res.json();
                        
                        let prevAllCount = this.allChats.length;
                        
                        this.allChats = data.all_chats || [];
                        this.activeLeads = data.active || [];
                        this.activeOthersLeads = data.active_others || [];
                        this.endedLeads = data.ended || [];

                        // Sound if new chat
                        if (this.allChats.length > prevAllCount && prevAllCount > 0) {
                            this.playPingSound();
                        }

                        // Update current chat if open
                        if (this.currentChat) {
                            let all = [...this.allChats, ...this.activeLeads, ...this.activeOthersLeads, ...this.endedLeads];
                            let updated = all.find(l => l.id === this.currentChat.id);
                            if (updated) {
                                let oldHistory = this.currentChat.chat_history;
                                this.currentChat = updated;
                                this.markAsRead(updated); // auto-mark read since chat is open
                                if (updated.chat_history !== oldHistory) {
                                    this.scrollToBottom();
                                    // Sound for new user message
                                    let history = JSON.parse(updated.chat_history || '[]');
                                    let lastMsg = history[history.length - 1];
                                    if (lastMsg && lastMsg.sender === 'user') {
                                        this.playPingSound();
                                    }
                                }
                            }
                        }
                    } catch(e) {
                        console.error('Polling error', e);
                    }
                },

                startPolling() {
                    this.pollTimer = setInterval(() => { this.pollData(); }, 3000);
                },

                playPingSound() {
                    let now = Date.now();
                    if (now - this.lastPingTime < 2000) return;
                    this.lastPingTime = now;
                    try {
                        let ctx = new (window.AudioContext || window.webkitAudioContext)();
                        let osc = ctx.createOscillator();
                        let gain = ctx.createGain();
                        osc.connect(gain); gain.connect(ctx.destination);
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(600, ctx.currentTime);
                        osc.frequency.exponentialRampToValueAtTime(1000, ctx.currentTime + 0.1);
                        gain.gain.setValueAtTime(0, ctx.currentTime);
                        gain.gain.linearRampToValueAtTime(0.3, ctx.currentTime + 0.05);
                        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
                        osc.start(ctx.currentTime); osc.stop(ctx.currentTime + 0.3);
                    } catch(e){}
                },

                selectChat(lead) {
                    this.currentChat = lead;
                    this.markAsRead(lead);
                    this.scrollToBottom();
                },

                async claimChat(leadId) {
                    try {
                        let res = await fetch('/helpdesk/claim', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                            body: JSON.stringify({ lead_id: leadId })
                        });
                        let data = await res.json();
                        
                        if (data.success) {
                            this.activeTab = 'active';
                            await this.pollData();
                            let claimed = this.activeLeads.find(l => l.id === leadId);
                            if (claimed) this.selectChat(claimed);
                        } else {
                            this.showAlert('Gagal Mengambil Chat', data.error || 'Terjadi kesalahan.');
                            this.pollData();
                        }
                    } catch(e) {
                        this.showAlert('Kesalahan Jaringan', 'Gagal menghubungi server.');
                    }
                },

                async sendMessage() {
                    if (!this.inputText.trim() || !this.currentChat) return;
                    let msg = this.inputText;
                    this.inputText = '';
                    
                    try {
                        let res = await fetch('/helpdesk/send', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                            body: JSON.stringify({ lead_id: this.currentChat.id, message: msg })
                        });
                        let data = await res.json();
                        if (!data.success) {
                            this.showAlert('Gagal Mengirim', data.error || 'Pesan gagal dikirim.');
                        }
                        this.pollData();
                    } catch(e) {
                        this.showAlert('Kesalahan Jaringan', 'Gagal mengirim pesan.');
                    }
                },

                async endChat(leadId) {
                    try {
                        let res = await fetch('/helpdesk/end', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                            body: JSON.stringify({ lead_id: leadId })
                        });
                        let data = await res.json();
                        if (data.success) {
                            this.currentChat = null;
                            this.pollData();
                        } else {
                            this.showAlert('Gagal', data.error || 'Gagal mengakhiri chat.');
                        }
                    } catch(e) {
                        this.showAlert('Kesalahan Jaringan', 'Gagal mengakhiri chat.');
                    }
                },

                // ===== Unread Tracking (localStorage) =====
                _getReadState() {
                    try {
                        return JSON.parse(localStorage.getItem('helpdesk_read_' + this.myId) || '{}');
                    } catch(e) { return {}; }
                },

                _saveReadState(state) {
                    try {
                        localStorage.setItem('helpdesk_read_' + this.myId, JSON.stringify(state));
                    } catch(e) {}
                },

                markAsRead(lead) {
                    let history = this.getChatHistory(lead);
                    let state = this._getReadState();
                    state['lead_' + lead.id] = history.length;
                    this._saveReadState(state);
                },

                getUnreadCount(lead) {
                    let history = this.getChatHistory(lead);
                    let state = this._getReadState();
                    let lastRead = state['lead_' + lead.id] || 0;
                    let unread = history.length - lastRead;
                    return unread > 0 ? unread : 0;
                },

                getUnreadRoomCount(leads) {
                    let count = 0;
                    for (let lead of leads) {
                        if (this.getUnreadCount(lead) > 0) count++;
                    }
                    return count;
                },

                // ===== Helper Methods =====
                getChatHistory(lead) {
                    if (!lead || !lead.chat_history) return [];
                    try { return JSON.parse(lead.chat_history); } catch(e) { return []; }
                },

                getLeadName(lead) {
                    return lead.name || 'Pengunjung #' + lead.id;
                },

                getLeadInitial(lead) {
                    let name = lead.name || 'P';
                    return name.charAt(0).toUpperCase();
                },

                getLeadTime(lead) {
                    let history = this.getChatHistory(lead);
                    if (history.length > 0) {
                        return history[history.length - 1].time || '';
                    }
                    return '';
                },

                getLastMessagePreview(lead) {
                    let history = this.getChatHistory(lead);
                    if (history.length > 0) {
                        let last = history[history.length - 1];
                        let prefix = '';
                        if (last.sender === 'bot') prefix = '🤖 ';
                        else if (last.sender === 'admin') prefix = '✓ ';
                        else if (last.sender === 'system') prefix = '⚙️ ';
                        let text = (last.text || '').replace(/<[^>]*>/g, '').substring(0, 80);
                        return prefix + text;
                    }
                    return lead.topic_context || '';
                },

                isOutgoing(msg) {
                    // Bot dan Admin = sisi kanan (tim kita)
                    // User = sisi kiri (pelanggan)
                    return msg.sender === 'admin' || msg.sender === 'bot';
                },

                getSenderLabel(msg) {
                    if (msg.sender === 'user') return this.currentChat ? this.getLeadName(this.currentChat) : 'Pelanggan';
                    if (msg.sender === 'bot') return '🤖 Chatbot AI';
                    if (msg.sender === 'admin') return '✅ ' + (msg.agent || 'Helpdesk');
                    return msg.sender;
                },

                getSenderColor(msg) {
                    if (msg.sender === 'user') return 'text-teal-600';
                    if (msg.sender === 'bot') return 'text-purple-600';
                    if (msg.sender === 'admin') return 'text-green-700';
                    return 'text-gray-500';
                },

                formatMessage(text) {
                    if (!text) return '';
                    text = text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    text = text.replace(/\n/g, '<br>');
                    text = text.replace(/\*([^\*]+)\*/g, '<strong>$1</strong>');
                    text = text.replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" class="text-blue-600 underline">$1</a>');
                    return text;
                },

                scrollToBottom() {
                    setTimeout(() => {
                        let box = document.getElementById('chat-messages-container');
                        if (box) box.scrollTop = box.scrollHeight;
                    }, 100);
                }
            }
        }
    </script>
</body>
</html>
