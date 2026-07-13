@extends('layouts.admin-app')
@section('title', 'Live Chat')
@section('header_title', 'Live Chat')

@section('content')
<div class="mx-4 sm:mx-0">
<div 
         x-data="{ 
            pendingChats: [], activeChats: [], endedChats: [], currentChat: null, inputText: '',
            notifEnabled: false, unreadChats: {},
            showHistory: false, // Tambahan state untuk membuka/menutup menu riwayat
            
            initLive() {
                if (Notification.permission === 'granted') this.notifEnabled = true;
                setInterval(() => this.pollData(), 3000);
                this.pollData();
            },
            
            enableNotif() {
                Notification.requestPermission().then(perm => { if (perm === 'granted') this.notifEnabled = true; });
                this.playPing();
            },

            getLastMsg(historyStr, defaultTopic) {
                let h = JSON.parse(historyStr || '[]');
                if(h.length > 0) {
                    let text = h[h.length - 1].text;
                    return text ? text.replace(/(<([^>]+)>)/gi, '') : defaultTopic;
                }
                return defaultTopic;
            },
            
            async pollData() {
                try {
                    let res = await fetch('/admin/chatbot/live/poll');
                    let data = await res.json();
                    
                    if (data.pending.length > this.pendingChats.length) {
                        this.playPing();
                        if (this.notifEnabled && Notification.permission === 'granted') {
                            let notif = new Notification('💬 Live Chat Baru!', { body: 'Ada user yang menunggu.', icon: '/favicon.ico' });
                            notif.onclick = function() { window.focus(); };
                        }
                    }
                    
                    data.active.forEach(act => {
                        let oldActive = this.activeChats.find(c => c.id === act.id);
                        let oldLen = oldActive ? JSON.parse(oldActive.chat_history || '[]').length : 0;
                        let newLen = JSON.parse(act.chat_history || '[]').length;
                        
                        if(newLen > oldLen) {
                            if(this.currentChat?.id === act.id) {
                                this.playPing(); setTimeout(() => { this.scrollDown() }, 100);
                            } else {
                                this.unreadChats[act.id] = true;
                                this.playPing();
                            }
                        }
                    });
                    
                    this.pendingChats = data.pending;
                    this.activeChats = data.active;
                    this.endedChats = data.ended || [];
                    
                    if(this.currentChat) {
                        this.currentChat = this.activeChats.find(c => c.id === this.currentChat.id) || 
                                           this.endedChats.find(c => c.id === this.currentChat.id) || null;
                    }
                } catch(e) {}
            },

            openChat(chat) {
                this.unreadChats[chat.id] = false;
                this.currentChat = chat;
                setTimeout(()=>this.scrollDown(), 100);
            },

            async actionChat(id, action) {
                try {
                    await fetch('/admin/chatbot/live/action', {
                        method: 'POST', 
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                        body: JSON.stringify({ lead_id: id, action: action })
                    });
                    if(action === 'end' && this.currentChat) {
                        this.currentChat.live_chat_status = 'ended'; 
                    }
                    this.pollData();
                } catch(e) {}
            },

            async sendMessage() {
                if(!this.inputText.trim() || !this.currentChat) return;
                let msgText = this.inputText; this.inputText = '';
                
                let history = JSON.parse(this.currentChat.chat_history || '[]');
                history.push({ sender: 'admin', text: msgText, time: new Date().toLocaleTimeString('id-ID', {day: 'numeric', month: 'short', hour: '2-digit', minute:'2-digit'}) });
                this.currentChat.chat_history = JSON.stringify(history);
                this.scrollDown();
                
                try {
                    await fetch('/admin/chatbot/live/send', {
                        method: 'POST', 
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                        body: JSON.stringify({ lead_id: this.currentChat.id, message: msgText })
                    });
                    this.pollData();
                } catch(e) {}
            },

            playPing() { try { let ctx = new (window.AudioContext || window.webkitAudioContext)(); let osc = ctx.createOscillator(); let gain = ctx.createGain(); osc.connect(gain); gain.connect(ctx.destination); osc.type = 'sine'; osc.frequency.setValueAtTime(800, ctx.currentTime); osc.frequency.exponentialRampToValueAtTime(1200, ctx.currentTime + 0.1); gain.gain.setValueAtTime(0, ctx.currentTime); gain.gain.linearRampToValueAtTime(0.3, ctx.currentTime + 0.02); gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.5); osc.start(ctx.currentTime); osc.stop(ctx.currentTime + 0.5); } catch(e){} },
            scrollDown() { setTimeout(() => { let el = document.getElementById('live-chat-box'); if(el) el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' }); }, 100); }
         }" 
         x-init="initLive()">
        
        <div x-show="!notifEnabled" class="bg-blue-50 border border-blue-200 p-4 rounded-xl mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 rounded-full text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg></div>
                <div><h4 class="font-bold text-slate-800">Aktifkan Notifikasi</h4><p class="text-xs text-slate-500">Izinkan browser untuk memunculkan suara saat pesan masuk.</p></div>
            </div>
            <button @click="enableNotif()" class="whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all">Izinkan Sekarang</button>
        </div>

        <div class="flex flex-col md:flex-row gap-6 h-[70vh]">
            <div class="w-full md:w-1/3 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col overflow-hidden">
                
                <div class="shrink-0 border-b border-slate-100">
                    <button @click="showHistory = !showHistory" class="w-full p-4 bg-slate-100/50 hover:bg-slate-100 flex justify-between items-center transition-colors">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <h3 class="font-bold text-slate-600 text-xs uppercase tracking-wider">Riwayat Obrolan</h3>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300" :class="showHistory ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    
                    <div x-show="showHistory" x-transition.opacity style="display: none;" class="overflow-y-auto max-h-[30vh] bg-slate-50/30 border-t border-slate-100">
                        <template x-for="chat in endedChats" :key="chat.id">
                            <div @click="openChat(chat)" class="p-3 border-b border-slate-100 cursor-pointer hover:bg-white transition-colors" :class="currentChat?.id === chat.id ? 'bg-white border-l-4 border-slate-400' : ''">
                                <p class="text-sm font-bold text-slate-500 truncate">
                                    <span x-show="chat.user" x-text="chat.user?.name"></span>
                                    <span x-show="!chat.user">Guest (<span x-text="chat.ip_address"></span>)</span>
                                </p>
                                <p class="text-[10px] text-slate-400 truncate mt-0.5" x-text="getLastMsg(chat.chat_history, 'Selesai')"></p>
                            </div>
                        </template>
                        <div x-show="endedChats.length === 0" class="p-4 text-center text-[10px] text-slate-400 italic">Belum ada riwayat.</div>
                    </div>
                </div>

                <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center shrink-0">
                    <h3 class="font-bold text-slate-800">Menunggu (Pending)</h3>
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full" x-show="pendingChats.length > 0" x-text="pendingChats.length"></span>
                </div>
                <div class="overflow-y-auto max-h-[25vh] shrink-0">
                    <template x-for="chat in pendingChats" :key="chat.id">
                        <div class="p-3 border-b border-slate-100 bg-amber-50/30">
                            <p class="text-xs font-bold text-slate-800 mb-1">
                                <span x-show="chat.user" x-text="chat.user?.name"></span>
                                <span x-show="!chat.user">Guest (<span x-text="chat.ip_address"></span>)</span>
                            </p>
                            <p class="text-[10px] text-slate-500 mb-2 truncate italic" x-text="getLastMsg(chat.chat_history, chat.topic_context)"></p>
                            <div class="flex gap-2">
                                <button @click="actionChat(chat.id, 'accept')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-[10px] font-bold py-1.5 rounded transition-colors">Terima</button>
                                <button @click="actionChat(chat.id, 'reject')" class="flex-1 bg-slate-200 hover:bg-red-500 hover:text-white text-slate-600 text-[10px] font-bold py-1.5 rounded transition-colors">Tolak</button>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div class="p-4 bg-slate-50 border-y border-slate-100 shrink-0">
                    <h3 class="font-bold text-slate-800">Obrolan Aktif</h3>
                </div>
                <div class="overflow-y-auto flex-1 min-h-[100px]">
                    <template x-for="chat in activeChats" :key="chat.id">
                        <div @click="openChat(chat)" class="p-3 border-b border-slate-100 cursor-pointer hover:bg-slate-50 transition-colors relative" :class="currentChat?.id === chat.id ? 'bg-blue-50 border-l-4 border-indigo-500' : ''">
                            <div x-show="unreadChats[chat.id] && currentChat?.id !== chat.id" class="absolute right-3 top-3 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping shadow-[0_0_8px_rgba(239,68,68,0.8)]"></div>
                            <div x-show="unreadChats[chat.id] && currentChat?.id !== chat.id" class="absolute right-3 top-3 w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                            
                            <p class="text-sm font-bold text-slate-800 pr-4 truncate">
                                <span x-show="chat.user" x-text="chat.user?.name"></span>
                                <span x-show="!chat.user">Guest (<span x-text="chat.ip_address"></span>)</span>
                            </p>
                            <p class="text-xs text-slate-500 truncate mt-0.5" x-text="getLastMsg(chat.chat_history, chat.topic_context)"></p>
                        </div>
                    </template>
                </div>
                
            </div>
            
            <div class="w-full md:w-2/3 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <template x-if="!currentChat">
                    <div class="flex-1 flex flex-col items-center justify-center text-slate-400">
                        <svg class="w-16 h-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        <p>Pilih obrolan dari daftar untuk mulai membalas.</p>
                    </div>
                </template>
                
                <template x-if="currentChat">
                    <div class="flex flex-col h-full">
                        <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                            <div>
                                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                    <span x-show="currentChat.user" x-text="currentChat.user?.name"></span>
                                    <span x-show="!currentChat.user">Guest (<span x-text="currentChat.ip_address"></span>)</span>
                                    <span x-show="currentChat.live_chat_status === 'active'" class="px-2 py-0.5 bg-green-100 text-green-700 text-[9px] uppercase rounded-full">Online</span>
                                </h3>
                                <p class="text-[10px] text-slate-500 font-mono mt-0.5">Session ID: <span x-text="currentChat.id"></span></p>
                            </div>
                            <button x-show="currentChat.live_chat_status === 'active'" @click="actionChat(currentChat.id, 'end')" class="text-xs bg-red-100 text-red-600 font-bold px-3 py-1.5 rounded-lg hover:bg-red-200 transition-colors">Akhiri Sesi</button>
                        </div>
                        
                        <div id="live-chat-box" class="flex-1 overflow-y-auto p-4 space-y-3 bg-slate-50/50">
                            <template x-for="(msg, i) in JSON.parse(currentChat.chat_history || '[]')" :key="i">
                                <div class="flex flex-col" :class="(msg.sender === 'admin' || msg.sender === 'bot') ? 'items-end' : 'items-start'">
                                    <div class="flex items-baseline gap-1.5 mb-0.5 px-1" :class="(msg.sender === 'admin' || msg.sender === 'bot') ? 'flex-row-reverse' : ''">
                                        <span class="text-[9px] text-slate-500 font-bold" x-text="msg.sender.toUpperCase()"></span>
                                        <span class="text-[8px] text-slate-400" x-show="msg.time" x-text="msg.time"></span>
                                    </div>
                                    <div class="max-w-[80%] px-3 py-2 rounded-xl text-sm shadow-sm" :class="(msg.sender === 'admin' || msg.sender === 'bot') ? 'bg-blue-500 text-white rounded-tr-sm' : 'bg-white border border-slate-200 text-slate-700 rounded-tl-sm'" x-html="msg.text"></div>
                                </div>
                            </template>
                        </div>
                        
                        <form x-show="currentChat.live_chat_status === 'active'" @submit.prevent="sendMessage()" class="p-3 bg-white border-t border-slate-100 flex gap-2">
                            <input type="text" x-model="inputText" placeholder="Ketik balasan CS di sini..." class="flex-1 px-4 py-2.5 bg-slate-100 border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm transition-all">
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-bold text-sm hover:bg-blue-700 transition-colors">Kirim</button>
                        </form>

                        <div x-show="currentChat.live_chat_status === 'ended'" class="p-4 bg-slate-100 text-center text-xs font-bold text-slate-500">
                            Sesi obrolan ini telah berakhir.
                        </div>
                    </div>
                </template>
            </div>
        </div>
    


</div>
@endsection
