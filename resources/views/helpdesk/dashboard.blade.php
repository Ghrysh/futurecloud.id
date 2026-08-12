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
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; margin: 0; padding: 0; height: 100vh; overflow: hidden; }
        .bg-wa-header { background-color: #f0f2f5; }
        .bg-wa-body { background-color: #efeae2; background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); opacity: 0.9; }
        .bg-wa-chat-in { background-color: #ffffff; }
        .bg-wa-chat-out { background-color: #d9fdd3; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    
    <div class="flex w-full h-full" x-data="helpdeskApp()">
        
        <!-- Sidebar Kiri -->
        <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col bg-white border-r border-gray-200 z-10 shrink-0">
            <!-- Header Sidebar -->
            <div class="h-16 bg-wa-header flex items-center justify-between px-4 py-2 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300">
                        @if($helpdesk->avatar)
                            <img src="{{ $helpdesk->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500 font-bold text-lg bg-gray-200">
                                {{ substr($helpdesk->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800">{{ $helpdesk->name }}</h2>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <p class="text-xs text-gray-500">Online</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{ route('helpdesk.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-500 transition-colors" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex bg-white border-b border-gray-100 p-2">
                <button @click="activeTab = 'pending'" class="flex-1 py-1.5 text-sm font-medium rounded transition-colors relative" :class="activeTab === 'pending' ? 'bg-gray-100 text-gray-800' : 'text-gray-500 hover:bg-gray-50'">
                    Menunggu
                    <span x-show="pendingLeads.length > 0" class="absolute top-1 right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 rounded-full" x-text="pendingLeads.length"></span>
                </button>
                <button @click="activeTab = 'active'" class="flex-1 py-1.5 text-sm font-medium rounded transition-colors relative" :class="activeTab === 'active' ? 'bg-gray-100 text-gray-800' : 'text-gray-500 hover:bg-gray-50'">
                    Obrolan
                    <span x-show="activeLeads.length > 0" class="absolute top-1 right-2 bg-green-500 text-white text-[10px] font-bold px-1.5 rounded-full" x-text="activeLeads.length"></span>
                </button>
                <button @click="activeTab = 'history'" class="flex-1 py-1.5 text-sm font-medium rounded transition-colors" :class="activeTab === 'history' ? 'bg-gray-100 text-gray-800' : 'text-gray-500 hover:bg-gray-50'">
                    Riwayat
                </button>
            </div>

            <!-- Daftar Chat -->
            <div class="flex-1 overflow-y-auto bg-white">
                
                <!-- Tab: Pending -->
                <div x-show="activeTab === 'pending'">
                    <div x-show="pendingLeads.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        <p class="text-sm">Tidak ada pesan menunggu</p>
                    </div>
                    
                    <template x-for="lead in pendingLeads" :key="lead.id">
                        <div class="border-b border-gray-100 p-3 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="font-semibold text-gray-800 text-sm truncate" x-text="lead.name || 'Guest ' + lead.id"></h3>
                                <span class="text-xs text-orange-500 font-medium">Menunggu</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-2 truncate" x-text="lead.topic_context || 'Butuh bantuan'"></p>
                            <button @click="claimChat(lead.id)" class="w-full bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold py-1.5 rounded transition-colors">
                                Ambil Chat
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Tab: Active -->
                <div x-show="activeTab === 'active'">
                    <div x-show="activeLeads.length === 0 && activeOthersLeads.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <p class="text-sm">Belum ada obrolan aktif</p>
                    </div>

                    <!-- Obrolan Saya -->
                    <div x-show="activeLeads.length > 0" class="px-3 py-1 bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500">
                        Ditangani oleh Anda
                    </div>
                    <template x-for="lead in activeLeads" :key="lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors" :class="currentChat && currentChat.id === lead.id ? 'bg-gray-100' : ''">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <span class="text-blue-600 font-bold text-lg" x-text="(lead.name || 'G').charAt(0).toUpperCase()"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h3 class="font-semibold text-gray-800 text-sm truncate" x-text="lead.name || 'Guest ' + lead.id"></h3>
                                </div>
                                <p class="text-xs text-gray-500 truncate" x-text="getLastMessageText(lead)"></p>
                            </div>
                        </div>
                    </template>

                    <!-- Obrolan Helpdesk Lain -->
                    <div x-show="activeOthersLeads.length > 0" class="px-3 py-1 bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 mt-2">
                        Ditangani Helpdesk Lain
                    </div>
                    <template x-for="lead in activeOthersLeads" :key="'other_'+lead.id">
                        <div class="flex items-center gap-3 p-3 border-b border-gray-100 opacity-60">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                                <span class="text-gray-500 font-bold" x-text="(lead.name || 'G').charAt(0).toUpperCase()"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h3 class="font-semibold text-gray-700 text-sm truncate" x-text="lead.name || 'Guest ' + lead.id"></h3>
                                </div>
                                <p class="text-[10px] text-orange-600 font-medium truncate" x-text="'Sedang dilayani oleh ' + lead.helpdesk_name"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Tab: History -->
                <div x-show="activeTab === 'history'">
                    <div x-show="endedLeads.length === 0" class="flex flex-col items-center justify-center p-8 text-gray-400 h-64 text-center">
                        <p class="text-sm">Riwayat obrolan kosong</p>
                    </div>
                    <template x-for="lead in endedLeads" :key="'ended_'+lead.id">
                        <div @click="selectChat(lead)" class="flex items-center gap-3 p-3 border-b border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors" :class="currentChat && currentChat.id === lead.id ? 'bg-gray-100' : ''">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                                <span class="text-gray-500 font-bold" x-text="(lead.name || 'G').charAt(0).toUpperCase()"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h3 class="font-medium text-gray-700 text-sm truncate" x-text="lead.name || 'Guest ' + lead.id"></h3>
                                    <span class="text-[10px] text-gray-400">Selesai</span>
                                </div>
                                <p class="text-[10px] text-gray-500 truncate" x-text="'CS: ' + (lead.helpdesk_name || 'Virtual Assistant')"></p>
                            </div>
                        </div>
                    </template>
                </div>

            </div>
        </div>

        <!-- Area Chat Kanan -->
        <div class="flex-1 flex flex-col bg-wa-body relative hidden md:flex">
            
            <!-- Welcome Screen (No Chat Selected) -->
            <div x-show="!currentChat" class="absolute inset-0 z-20 bg-[#f0f2f5] flex flex-col items-center justify-center border-l border-gray-200">
                <img src="https://futurecloud.id/assets/images/logo.png" alt="Logo" class="h-12 opacity-30 mb-6 grayscale">
                <h1 class="text-3xl font-light text-gray-600 mb-4">FutureCloud Helpdesk</h1>
                <p class="text-gray-500 text-sm max-w-md text-center">Pilih pesan dari daftar di sebelah kiri untuk mulai membalas. Pelanggan menanti bantuan Anda.</p>
                <div class="mt-10 flex items-center gap-2 text-xs text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    End-to-end encrypted connection
                </div>
            </div>

            <!-- Active Chat Area -->
            <template x-if="currentChat">
                <div class="flex flex-col h-full w-full">
                    
                    <!-- Chat Header -->
                    <div class="h-16 bg-wa-header flex justify-between items-center px-4 border-l border-gray-200 shadow-sm z-10 shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <span class="text-blue-600 font-bold text-lg" x-text="(currentChat.name || 'G').charAt(0).toUpperCase()"></span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800" x-text="currentChat.name || 'Guest ' + currentChat.id"></h3>
                                <p class="text-xs text-gray-500" x-text="currentChat.phone || currentChat.ip_address"></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <template x-if="currentChat.live_chat_status === 'active' && currentChat.helpdesk_id == {{ $helpdesk->id }}">
                                <button @click="endChat(currentChat.id)" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded hover:bg-red-100 border border-red-100 transition-colors">
                                    Akhiri Sesi
                                </button>
                            </template>
                            <template x-if="currentChat.live_chat_status === 'ended'">
                                <span class="px-2 py-1 bg-gray-200 text-gray-600 text-xs font-semibold rounded">Sesi Berakhir</span>
                            </template>
                        </div>
                    </div>

                    <!-- Chat Box -->
                    <div id="chat-messages-container" class="flex-1 overflow-y-auto p-4 sm:p-6 md:px-[10%]">
                        <template x-for="(msg, i) in getChatHistory(currentChat)" :key="i">
                            <div class="mb-3 flex flex-col" :class="isOwnMessage(msg) ? 'items-end' : 'items-start'">
                                
                                <div class="max-w-[85%] sm:max-w-[75%] rounded-lg px-3 py-2 shadow-sm relative text-sm"
                                     :class="isOwnMessage(msg) ? 'bg-wa-chat-out rounded-tr-none' : 'bg-wa-chat-in rounded-tl-none'">
                                    
                                    <!-- Sender Name (if not me) -->
                                    <template x-if="!isOwnMessage(msg) && msg.sender !== 'user'">
                                        <div class="text-[11px] font-bold mb-1" 
                                             :class="msg.sender === 'system' ? 'text-orange-500' : 'text-purple-600'" 
                                             x-text="msg.sender === 'system' ? 'System' : (msg.agent || 'Bot')"></div>
                                    </template>

                                    <!-- Message Text -->
                                    <div class="text-gray-800" style="word-wrap: break-word;" x-html="formatMessage(msg.text)"></div>
                                    
                                    <!-- Time -->
                                    <div class="text-[10px] text-gray-400 text-right mt-1" x-text="msg.time || ''"></div>
                                    
                                    <!-- Tail -->
                                    <div class="absolute top-0 w-3 h-3"
                                         :class="isOwnMessage(msg) ? '-right-2 text-wa-chat-out' : '-left-2 text-wa-chat-in'"
                                         x-show="shouldShowTail(msg, i)">
                                        <svg viewBox="0 0 8 13" width="8" height="13" :fill="isOwnMessage(msg) ? '#d9fdd3' : '#ffffff'">
                                            <path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                            <path :d="isOwnMessage(msg) ? 'M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z' : 'M2.812 0H8v11.193L1.533 2.568C.474 1.156 1.042 0 2.812 0z'"></path>
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </template>
                    </div>

                    <!-- Input Area -->
                    <div class="bg-[#f0f2f5] p-3 flex items-center gap-3 w-full shrink-0 relative z-10" x-show="currentChat.live_chat_status === 'active' && currentChat.helpdesk_id == {{ $helpdesk->id }}">
                        <form @submit.prevent="sendMessage()" class="flex-1 flex gap-2">
                            <input type="text" x-model="inputText" placeholder="Ketik pesan..." class="flex-1 py-2.5 px-4 rounded-lg bg-white border-none focus:ring-0 focus:outline-none text-gray-700 shadow-sm" autocomplete="off">
                            <button type="submit" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-500 hover:text-blue-500 transition-colors" :disabled="!inputText.trim()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"></path></svg>
                            </button>
                        </form>
                    </div>

                    <!-- Disabled Input (Ended or Others) -->
                    <div class="bg-[#f0f2f5] p-3 text-center text-gray-500 text-sm w-full shrink-0 z-10" x-show="currentChat.live_chat_status !== 'active' || currentChat.helpdesk_id != {{ $helpdesk->id }}">
                        Anda tidak dapat mengirim pesan ke percakapan ini.
                    </div>

                </div>
            </template>
        </div>

    </div>

    <script>
        function helpdeskApp() {
            return {
                activeTab: 'pending',
                pendingLeads: [],
                activeLeads: [],
                activeOthersLeads: [],
                endedLeads: [],
                currentChat: null,
                inputText: '',
                pollTimer: null,
                lastPingTime: 0,
                csrf: document.querySelector('meta[name="csrf-token"]').content,

                init() {
                    this.pollData();
                    this.startPolling();
                },

                async pollData() {
                    try {
                        let res = await fetch('/helpdesk/poll');
                        let data = await res.json();
                        
                        // Check for new pending chats to play ping
                        if (data.pending.length > this.pendingLeads.length) {
                            this.playPingSound();
                        }

                        this.pendingLeads = data.pending || [];
                        this.activeLeads = data.active || [];
                        this.activeOthersLeads = data.active_others || [];
                        this.endedLeads = data.ended || [];

                        // Update current chat if open
                        if (this.currentChat) {
                            let updated = [...this.pendingLeads, ...this.activeLeads, ...this.activeOthersLeads, ...this.endedLeads].find(l => l.id === this.currentChat.id);
                            if (updated) {
                                if (updated.chat_history !== this.currentChat.chat_history) {
                                    this.currentChat = updated;
                                    this.scrollToBottom();
                                    
                                    // Play ping if new message in active chat and not sent by me
                                    let history = JSON.parse(updated.chat_history || '[]');
                                    let lastMsg = history[history.length - 1];
                                    if(updated.live_chat_status === 'active' && lastMsg && lastMsg.sender === 'user') {
                                        this.playPingSound();
                                    }
                                } else {
                                    this.currentChat.live_chat_status = updated.live_chat_status;
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
                    if (now - this.lastPingTime < 2000) return; // limit 1 ping per 2 detik
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
                    this.scrollToBottom();
                    
                    // On mobile, scroll to top might be needed or hide sidebar
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
                            
                            // Select newly claimed chat
                            let claimed = this.activeLeads.find(l => l.id === leadId);
                            if(claimed) this.selectChat(claimed);
                        } else {
                            alert(data.error || 'Gagal mengambil chat.');
                            this.pollData(); // refresh
                        }
                    } catch(e) {
                        alert('Terjadi kesalahan jaringan.');
                    }
                },

                async sendMessage() {
                    if (!this.inputText.trim() || !this.currentChat) return;
                    let msg = this.inputText;
                    this.inputText = ''; // clear immediately
                    
                    try {
                        let res = await fetch('/helpdesk/send', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                            body: JSON.stringify({ lead_id: this.currentChat.id, message: msg })
                        });
                        let data = await res.json();
                        if(!data.success) {
                            alert(data.error || 'Gagal mengirim pesan');
                        }
                        this.pollData(); // refresh immediately
                    } catch(e) {
                        alert('Gagal mengirim pesan.');
                    }
                },

                async endChat(leadId) {
                    if(!confirm('Yakin ingin mengakhiri sesi chat ini?')) return;
                    
                    try {
                        let res = await fetch('/helpdesk/end', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                            body: JSON.stringify({ lead_id: leadId })
                        });
                        let data = await res.json();
                        if(data.success) {
                            this.currentChat = null;
                            this.pollData();
                        } else {
                            alert(data.error || 'Gagal mengakhiri chat.');
                        }
                    } catch(e) {
                        alert('Kesalahan jaringan.');
                    }
                },

                // Helper methods
                getChatHistory(lead) {
                    if(!lead || !lead.chat_history) return [];
                    try {
                        return JSON.parse(lead.chat_history);
                    } catch(e) { return []; }
                },

                getLastMessageText(lead) {
                    let history = this.getChatHistory(lead);
                    if(history.length > 0) {
                        let last = history[history.length - 1];
                        let prefix = last.sender === 'user' ? '' : (last.sender === 'system' ? '⚙️ ' : '✓ ');
                        return prefix + last.text;
                    }
                    return lead.topic_context || '';
                },

                isOwnMessage(msg) {
                    // Dalam konteks helpdesk, 'admin' berarti pesan keluar dari dashboard ini
                    return msg.sender === 'admin';
                },

                shouldShowTail(msg, index) {
                    // simplified: show tail for all messages (can be optimized to check previous message)
                    return true;
                },

                formatMessage(text) {
                    if(!text) return '';
                    // Convert line breaks
                    text = text.replace(/\n/g, '<br>');
                    // Basic bold (*text*)
                    text = text.replace(/\*([^\*]+)\*/g, '<strong>$1</strong>');
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
