<div x-data="chatbot()" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[999] font-sans">
    
    <button @click="toggleChat()" :class="isOpen ? 'scale-0 opacity-0' : 'scale-100 opacity-100'" 
        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full shadow-2xl flex items-center justify-center text-white hover:scale-110 hover:shadow-indigo-300 transition-all duration-300 absolute bottom-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
        <span x-show="unread > 0" class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow" x-text="unread"></span>
    </button>

    <div :class="isOpen ? 'scale-100 opacity-100 translate-y-0' : 'scale-95 opacity-0 translate-y-4 pointer-events-none'" 
        class="origin-bottom-right transition-all duration-300 absolute bottom-16 right-0 w-[90vw] sm:w-[380px] bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden flex flex-col h-[550px] max-h-[80vh]">
        
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 flex justify-between items-center relative overflow-hidden text-white shadow-md z-10">
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="flex items-center gap-3 relative z-10">
                <div class="relative">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-inner p-1">
                        <img src="{{ asset('favicon.svg') }}" alt="Bot" class="w-full h-full object-contain">
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-blue-600 rounded-full"></div>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">Mimin FutureCloud</h3>
                    <p class="text-[10px] text-blue-100 flex items-center gap-1">
                        <span class="relative flex h-1.5 w-1.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-green-400"></span></span>
                        Online & Siap Membantu
                    </p>
                </div>
            </div>
            
            <div class="flex items-center relative z-10 gap-1.5">
                <button @click="resetChat()" title="Mulai Chat Baru" class="text-white hover:text-blue-200 transition-colors bg-white/10 hover:bg-white/20 px-2 py-1.5 rounded-lg flex items-center gap-1 text-[11px] font-medium border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    New
                </button>
                <button @click="closeChat()" class="text-white hover:text-blue-200 transition-colors bg-white/10 hover:bg-white/20 p-1.5 rounded-lg border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        <div id="chat-scroll-area" class="flex-1 p-4 overflow-y-auto bg-slate-50 space-y-4 relative">
            
            <template x-if="messages.length === 0 && showTopics">
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full flex-shrink-0 flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="bg-white border border-blue-100 rounded-2xl rounded-tl-sm p-3 shadow-sm max-w-[85%] text-[13px] text-slate-700 leading-relaxed">
                        <p class="mb-2">Halo {{ Auth::check() ? Auth::user()->name : 'Kak' }}! 👋 Ada yang bisa Mimin bantu hari ini?</p>
                        <p class="font-medium text-slate-800 mb-2">Pilih salah satu topik di bawah ya:</p>
                        <div class="flex flex-col gap-2">
                            <template x-for="t in dynamicTopics" :key="t">
                                <button @click="setTopic(t)" class="text-left px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-colors border border-blue-100 font-medium break-words">
                                    💬 <span x-text="t"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </template>

            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.sender === 'user' ? 'flex items-end justify-end gap-2' : 'flex items-start gap-2'">
                    <template x-if="msg.sender === 'bot'">
                        <div class="w-7 h-7 bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full flex-shrink-0 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                        </div>
                    </template>
                    <div class="flex flex-col" :class="msg.sender === 'user' ? 'items-end max-w-[85%]' : 'items-start max-w-[85%]'">
                        <div x-html="msg.text" 
                            :class="msg.sender === 'user' ? 'bg-blue-600 text-white rounded-2xl rounded-tr-sm shadow-md' : 'bg-white border border-blue-100 text-slate-700 rounded-2xl rounded-tl-sm shadow-sm'"
                            class="p-3 text-[13px] leading-relaxed break-words">
                        </div>
                        <span class="text-[10px] text-slate-400 mt-1 px-1 font-medium" x-text="msg.time"></span>

                        <template x-if="msg.sender === 'bot' && index === messages.length - 1 && !isFinished && !askingContact">
                            <div class="flex flex-wrap gap-2 mt-2 mb-2">
                                <button @click="showTopics = true; scrollToBottom();" class="text-[11px] bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-100 px-3 py-1.5 rounded-full transition-all font-medium">Ubah Topik</button>
                                <button @click="askContact()" class="text-[11px] bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 px-3 py-1.5 rounded-full transition-all font-medium">Akhiri & Hubungi CS</button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <div x-show="isTyping" class="flex items-start gap-2">
                <div class="w-7 h-7 bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full flex-shrink-0 flex items-center justify-center shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                </div>
                <div class="bg-white border border-blue-100 rounded-2xl rounded-tl-sm p-3.5 shadow-sm flex gap-1">
                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
            
            <div x-show="showTopics && messages.length > 0" class="mt-4 bg-white border border-blue-100 rounded-2xl p-3 shadow-sm text-[13px] text-slate-700 leading-relaxed">
                <p class="font-medium text-slate-800 mb-2">Pilih topik baru:</p>
                <div class="flex flex-col gap-2">
                    <template x-for="t in dynamicTopics" :key="t">
                        <button @click="setTopic(t)" class="text-left px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-colors border border-blue-100 font-medium break-words">
                            💬 <span x-text="t"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white border-t border-slate-100">
            <div x-show="!isFinished" class="flex gap-2">
                <input type="text" x-model="userInput" @keydown.enter="sendMessage()" 
                    :disabled="showTopics"
                    :placeholder="askingContact ? 'Ketik Email / No Telepon Anda...' : (showTopics ? 'Pilih topik di atas dulu...' : 'Ketik pesan...')" 
                    class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all disabled:opacity-50">
                <button @click="sendMessage()" :disabled="!userInput.trim() || showTopics" 
                    class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 text-white w-11 h-11 flex items-center justify-center rounded-xl flex-shrink-0 transition-colors shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -ml-0.5" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                </button>
            </div>
            <div x-show="isFinished" class="text-center text-xs text-slate-500 py-2 bg-slate-50 rounded-lg">
                Sesi selesai. Klik tombol <b>New</b> di atas untuk chat ulang.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
        isOpen: false,
        unread: 0,
        isTyping: false,
        showTopics: true,
        dynamicTopics: [],
        selectedTopic: 'Umum',
        messages: [],
        userInput: '',
        leadId: null,
        isFinished: false,
        askingContact: false,

        async init() {
            let saved = sessionStorage.getItem('chatbotState');
            if (saved) {
                let state = JSON.parse(saved);
                this.messages = state.messages || [];
                this.selectedTopic = state.selectedTopic || 'Umum';
                this.showTopics = state.showTopics;
                this.leadId = state.leadId;
                this.isFinished = state.isFinished || false;
                this.askingContact = state.askingContact || false;
            }
            this.createNotificationSound();

            try {
                let res = await fetch('/chatbot/init');
                let data = await res.json();
                this.dynamicTopics = data.topics;
            } catch(e) {
                this.dynamicTopics = ['Layanan Cloud', 'Domain & SSL', 'Lainnya'];
            }
        },

        createNotificationSound() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                const audioCtx = new AudioContext();
                this.playNotificationSound = () => {
                    const now = audioCtx.currentTime;
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    osc.frequency.value = 659.25;
                    osc.type = 'sine';
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.exponentialRampToValueAtTime(0.01, now + 0.15);
                    osc.start(now);
                    osc.stop(now + 0.15);
                };
            } catch (e) { }
        },

        getCurrentTime() {
            const now = new Date();
            return `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
        },

        saveState() {
            sessionStorage.setItem('chatbotState', JSON.stringify({
                messages: this.messages,
                selectedTopic: this.selectedTopic,
                showTopics: this.showTopics,
                leadId: this.leadId,
                isFinished: this.isFinished,
                askingContact: this.askingContact
            }));
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if(this.isOpen) {
                this.unread = 0;
                this.scrollToBottom();
            }
        },

        closeChat() { this.isOpen = false; },

        // --- FUNGSI NEW CHAT ---
        resetChat() {
            this.messages = [];
            this.selectedTopic = 'Umum';
            this.showTopics = true;
            this.leadId = null; // Agar DB membuat riwayat/baris baru di backend
            this.isFinished = false;
            this.askingContact = false;
            sessionStorage.removeItem('chatbotState');
            this.scrollToBottom();
        },

        async setTopic(topic) {
            this.selectedTopic = topic;
            this.showTopics = false;
            this.messages.push({ sender: 'user', text: `Topik dipilih: ${topic}`, time: this.getCurrentTime() });
            
            this.isTyping = true;
            this.scrollToBottom();

            try {
                let res = await fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 
                        message: `Memilih topik: ${topic}`, 
                        topic: this.selectedTopic,
                        chat_history: this.messages,
                        lead_id: this.leadId,
                        is_init: true
                    })
                });
                
                let data = await res.json();
                if(data.lead_id) this.leadId = data.lead_id;

                setTimeout(() => {
                    this.isTyping = false;
                    this.messages.push({ sender: 'bot', text: data.reply, time: this.getCurrentTime() });
                    if(this.playNotificationSound) this.playNotificationSound();
                    if (!this.isOpen) this.unread++;
                    this.saveState();
                    this.scrollToBottom();
                }, 800);
            } catch (e) { this.isTyping = false; }
        },

        async askContact() {
            this.messages.push({ sender: 'user', text: 'Akhiri & Hubungi CS', time: this.getCurrentTime() });
            this.askingContact = true;
            this.isTyping = true;
            this.scrollToBottom();

            try {
                let res = await fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 
                        message: 'Akhiri & Hubungi CS', 
                        topic: this.selectedTopic,
                        chat_history: this.messages,
                        lead_id: this.leadId,
                        asking_contact: true
                    })
                });
                
                let data = await res.json();
                setTimeout(() => {
                    this.isTyping = false;
                    this.messages.push({ sender: 'bot', text: data.reply, time: this.getCurrentTime() });
                    if(this.playNotificationSound) this.playNotificationSound();
                    this.saveState();
                    this.scrollToBottom();
                }, 800);
            } catch (e) { this.isTyping = false; }
        },

        async sendMessage() {
            let msgText = this.userInput.trim();
            if (!msgText || this.showTopics || this.isFinished) return;

            this.messages.push({ sender: 'user', text: msgText, time: this.getCurrentTime() });
            this.userInput = '';
            this.isTyping = true;
            this.scrollToBottom();

            let payload = {
                message: msgText, 
                topic: this.selectedTopic, 
                chat_history: this.messages,
                lead_id: this.leadId
            };
            if (this.askingContact) payload.submitting_contact = true;

            try {
                let res = await fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                });
                
                let data = await res.json();
                if(data.lead_id) this.leadId = data.lead_id;

                setTimeout(() => {
                    this.isTyping = false;
                    this.messages.push({ sender: 'bot', text: data.reply, time: this.getCurrentTime() });
                    
                    if(this.playNotificationSound) this.playNotificationSound();
                    if (!this.isOpen) this.unread++;

                    if (data.is_finished) {
                        this.isFinished = true;
                        this.askingContact = false;
                    }
                    
                    this.saveState();
                    this.scrollToBottom();
                }, 800);

            } catch (e) {
                this.isTyping = false;
                this.messages.push({ sender: 'bot', text: 'Maaf, jaringan sedang bermasalah.', time: this.getCurrentTime() });
                this.saveState();
                this.scrollToBottom();
            }
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const el = document.getElementById('chat-scroll-area');
                if (el) el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
            });
        }
    }));
});
</script>