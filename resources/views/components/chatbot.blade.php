{{-- resources/views/components/chatbot.blade.php --}}

<div x-data="chatbot" class="fixed z-[9999] font-sans">
    
    <!-- Overlay untuk click outside (mobile & desktop) -->
    <div x-show="isOpen" 
         @click="closeChat()"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[9998]">
    </div>

    <!-- Chat Box Window - Muncul di ATAS bubble icon -->
    <div x-show="isOpen" 
         @click.stop
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         style="display: none;" 
         class="fixed bottom-24 right-5 md:bottom-[100px] md:right-6 bg-white w-[calc(100vw-40px)] max-w-[420px] lg:max-w-[460px] h-[70vh] md:h-[620px] lg:h-[680px] rounded-3xl shadow-2xl border border-gray-200/80 flex flex-col backdrop-blur-xl overflow-hidden z-[9999]">
        
        <!-- Header (Fixed at Top) -->
        <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 p-5 flex justify-between items-center text-white shadow-xl shrink-0 z-20">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-20 -translate-y-20"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-white rounded-full translate-x-16 translate-y-16"></div>
            </div>
            
            <div class="flex items-center gap-3.5 relative z-10">
                <div class="w-11 h-11 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/40 shadow-lg">
                    <i class="ri-customer-service-2-fill text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base tracking-tight mb-0.5">FutureCloud Assistant</h3>
                    <div class="flex items-center gap-1.5 opacity-95">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-300 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                        </span>
                        <span class="text-xs font-medium">Always Active</span>
                    </div>
                </div>
            </div>
            
            <button @click="closeChat()" class="hover:bg-white/20 p-2.5 rounded-xl transition-all cursor-pointer backdrop-blur-sm active:scale-95">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <!-- Messages List (Scrollable Area) -->
        <div id="chat-scroll-area" class="flex-1 overflow-y-auto min-h-0 p-4 md:p-5 bg-gradient-to-b from-gray-50/80 to-white space-y-4 relative scroll-smooth">
            
            <!-- Default Welcome Message -->
            <div class="flex items-start gap-3 animate-fade-in">
                <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shrink-0 ring-2 ring-blue-100 mt-0.5">
                    <i class="ri-robot-2-fill text-base"></i>
                </div>
                <div class="flex flex-col max-w-[82%]">
                    <!-- Header Chatbot -->
                    <div class="flex items-baseline gap-2 mb-1.5 ml-0.5">
                        <span class="font-bold text-blue-700 text-xs tracking-wide">FutureBot</span>
                        <span class="text-[10px] text-gray-400 font-medium" x-text="getCurrentTime()"></span>
                    </div>
                    <!-- Bubble -->
                    <div class="bg-white p-4 rounded-2xl rounded-tl-md shadow-md border border-gray-100 text-sm text-gray-700 leading-relaxed bot-content">
                        Halo! 👋 Selamat datang di <span class="font-bold text-blue-600">FutureCloud</span>.<br>
                        Saya siap membantu Anda dengan pertanyaan seputar layanan kami.
                    </div>
                </div>
            </div>

            <!-- Dynamic Messages Loop -->
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.sender === 'user' ? 'flex flex-row-reverse items-start gap-3' : 'flex items-start gap-3'" class="animate-fade-in relative z-10">
                    
                    <!-- Avatar -->
                    <div class="shrink-0 mt-0.5">
                        <template x-if="msg.sender === 'bot'">
                            <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg ring-2 ring-blue-100">
                                <i class="ri-robot-2-fill text-base"></i>
                            </div>
                        </template>
                        <template x-if="msg.sender === 'user'">
                            <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white shadow-lg ring-2 ring-gray-200">
                                <i class="ri-user-smile-fill text-base"></i>
                            </div>
                        </template>
                    </div>
                    
                    <div class="flex flex-col max-w-[82%]">
                        <!-- Sender Name & Time Header -->
                        <div class="flex items-baseline gap-2 mb-1.5" :class="msg.sender === 'user' ? 'flex-row-reverse mr-0.5' : 'ml-0.5'">
                            <span class="font-bold text-xs tracking-wide" 
                                  :class="msg.sender === 'user' ? 'text-gray-700' : 'text-blue-700'"
                                  x-text="msg.sender === 'user' ? 'You' : 'FutureBot'"></span>
                            <span class="text-[10px] text-gray-400 font-medium" x-text="msg.time"></span>
                        </div>

                        <!-- Chat Bubble -->
                        <div :class="msg.sender === 'user' 
                            ? 'bg-gradient-to-br from-blue-600 to-blue-700 text-white p-4 rounded-2xl rounded-tr-md shadow-lg text-sm border border-blue-500/20' 
                            : 'bg-white text-gray-700 p-4 rounded-2xl rounded-tl-md shadow-md border border-gray-100 text-sm bot-content'"
                            x-html="msg.message">
                        </div>
                    </div>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="isTyping" style="display: none;" class="flex items-start gap-3 animate-fade-in pb-2">
                <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shrink-0">
                    <i class="ri-robot-2-fill text-base"></i>
                </div>
                <div class="bg-white px-5 py-3.5 rounded-2xl rounded-tl-md shadow-md border border-gray-100 flex gap-2 items-center">
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-bounce"></span>
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.15s"></span>
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></span>
                </div>
            </div>
            
            <!-- Spacer for bottom scroll -->
            <div class="h-4"></div>
        </div>

        <!-- Input Area (Fixed at Bottom) -->
        <div class="p-4 md:p-5 bg-white border-t border-gray-200/80 shrink-0 relative z-30 pb-safe shadow-lg">
            <form @submit.prevent="sendMessage" class="relative">
                <div class="relative flex items-center bg-gray-50 rounded-2xl border-2 border-gray-200 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-100 transition-all duration-200">
                    <input type="text" x-model="userInput" 
                           placeholder="Ketik pesan Anda..." 
                           class="flex-1 bg-transparent text-gray-800 text-sm py-3.5 px-4 focus:outline-none placeholder:text-gray-400"
                           :disabled="isTyping"
                           autocomplete="off">
                    
                    <button type="submit" 
                            class="mr-2 p-2.5 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl transition-all shadow-lg disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer transform active:scale-95 hover:shadow-xl"
                            :disabled="!userInput.trim() || isTyping">
                        <i class="ri-send-plane-fill text-lg"></i>
                    </button>
                </div>
                
                <div class="text-center mt-2.5">
                    <p class="text-[10px] text-gray-400 font-medium flex items-center justify-center gap-1">
                        <i class="ri-shield-check-line text-xs"></i>
                        Powered by FutureCloud AI • Secure & Encrypted
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Button (Always visible at bottom) -->
    <div class="fixed bottom-5 right-5 md:bottom-6 md:right-6 z-[10000]">
        <button @click="toggleChat()" 
                class="group relative w-16 h-16 md:w-[70px] md:h-[70px] bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white rounded-full shadow-2xl transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer flex items-center justify-center ring-4 ring-blue-100/50 hover:ring-blue-200">
            
            <!-- PERBAIKAN: Menggunakan tag <span> agar tidak kena style global 'i' -->
            <span x-show="!isOpen" class="ri-message-3-fill text-3xl md:text-[32px] transition-transform group-hover:rotate-12"></span>
            
            <span x-show="isOpen" style="display: none;" class="ri-arrow-down-line text-3xl md:text-[32px] transition-transform group-hover:translate-y-1"></span>
            
            <!-- Notification Badge -->
            <span x-show="unreadCount > 0 && !isOpen" 
                  class="absolute -top-1 -right-1 h-7 w-7">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-7 w-7 bg-red-500 border-2 border-white items-center justify-center text-xs font-bold text-white shadow-lg" x-text="unreadCount"></span>
            </span>
        </button>
    </div>
</div>

<style>
    .bot-content b, .bot-content strong {
        color: #2563eb;
        font-weight: 700;
    }
    
    .bot-content a {
        color: #16a34a;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-thickness: 2px;
        text-underline-offset: 2px;
        transition: all 0.2s;
    }
    
    .bot-content a:hover {
        color: #15803d;
        text-decoration-thickness: 3px;
    }

    .bot-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .bot-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .bot-content li {
        margin-bottom: 0.375rem;
        line-height: 1.6;
    }

    .bot-content p {
        margin-bottom: 0.5rem;
    }

    @keyframes fade-in {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { 
        animation: fade-in 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
    }

    #chat-scroll-area::-webkit-scrollbar { 
        width: 6px; 
    }
    #chat-scroll-area::-webkit-scrollbar-track { 
        background: #f1f5f9;
        border-radius: 10px;
        margin: 8px 0;
    }
    #chat-scroll-area::-webkit-scrollbar-thumb { 
        background: #cbd5e1; 
        border-radius: 10px;
        transition: background 0.2s;
    }
    #chat-scroll-area::-webkit-scrollbar-thumb:hover { 
        background: #94a3b8; 
    }

    .pb-safe { 
        padding-bottom: max(16px, env(safe-area-inset-bottom)); 
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .animate-bounce {
        animation: bounce 1s infinite;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatbot', () => ({
            isOpen: false,
            userInput: '',
            messages: [],
            isTyping: false,
            unreadCount: 0,
            notificationSound: null,
            leadId: null,

            init() {
                // Initialize Audio
                this.createNotificationSound();
                this.initChat();
            },

            createNotificationSound() {
                try {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    const audioCtx = new AudioContext();
                    
                    this.playNotificationSound = () => {
                        const now = audioCtx.currentTime;
                        
                        const osc1 = audioCtx.createOscillator();
                        const gain1 = audioCtx.createGain();
                        osc1.connect(gain1);
                        gain1.connect(audioCtx.destination);
                        osc1.frequency.value = 659.25;
                        osc1.type = 'sine';
                        gain1.gain.setValueAtTime(0.3, now);
                        gain1.gain.exponentialRampToValueAtTime(0.01, now + 0.15);
                        osc1.start(now);
                        osc1.stop(now + 0.15);
                        
                        const osc2 = audioCtx.createOscillator();
                        const gain2 = audioCtx.createGain();
                        osc2.connect(gain2);
                        gain2.connect(audioCtx.destination);
                        osc2.frequency.value = 554.37;
                        osc2.type = 'sine';
                        gain2.gain.setValueAtTime(0, now + 0.08);
                        gain2.gain.setValueAtTime(0.3, now + 0.08);
                        gain2.gain.exponentialRampToValueAtTime(0.01, now + 0.23);
                        osc2.start(now + 0.08);
                        osc2.stop(now + 0.23);
                        
                        const osc3 = audioCtx.createOscillator();
                        const gain3 = audioCtx.createGain();
                        osc3.connect(gain3);
                        gain3.connect(audioCtx.destination);
                        osc3.frequency.value = 369.99;
                        osc3.type = 'sine';
                        gain3.gain.setValueAtTime(0, now + 0.16);
                        gain3.gain.setValueAtTime(0.35, now + 0.16);
                        gain3.gain.exponentialRampToValueAtTime(0.01, now + 0.4);
                        osc3.start(now + 0.16);
                        osc3.stop(now + 0.4);
                    };
                } catch (e) {
                    console.log('Web Audio API not supported');
                    this.notificationSound = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBgoOFhoeJi42PkZKUlZeZmpydn6Gio6SlpqeoqaqrrK2ur7CxsrO0tba3uLm6u7y9vr/AwcLDxMXGx8jJysvMzc7P0NHS09TV1tfY2drb3N3e3+Dh4uPk5ebn6Onq6+zt7u/w8fLz9PX29/j5+vv8/f7/AAECAwQFBgcICQoLDA0ODxAREhMUFRYXGBkaGxwdHh8gISIjJCUmJygpKissLS4vMDEyMzQ1Njc4OTo7PD0+P0BBQkNERUZHSElKS0xNTk9QUVJTVFVWV1hZWltcXV5fYGFiY2RlZmdoaWprbG1ub3BxcnN0dXZ3eHl6e3x9fn+AgYKDhIWGh4iJiouMjY6PkJGSk5SVlpeYmZqbnJ2en6ChoqOkpaanqKmqq6ytrq+wsbKztLW2t7i5uru8vb6/wMHCw8TFxsfIycrLzM3Oz9DR0tPU1dbX2Nna29zd3t/g4eLj5OXm5+jp6uvs7e7v8PHy8/T19vf4+fr7/P3+/w==');
                    this.notificationSound.volume = 0.4;
                    this.playNotificationSound = () => {
                        if (this.notificationSound) {
                            this.notificationSound.currentTime = 0;
                            this.notificationSound.play().catch(() => {});
                        }
                    };
                }
            },

            getCurrentTime() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                return `${hours}:${minutes}`;
            },

            async initChat() {
                try {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if(token) {
                        const response = await fetch('/chatbot/history', { 
                            headers: { 'X-CSRF-TOKEN': token } 
                        });
                        if (response.ok) {
                            this.messages = await response.json();
                            this.$nextTick(() => this.scrollToBottom());
                        }
                    }
                } catch (e) { 
                    console.error('Error loading chat history:', e); 
                }
            },

            toggleChat() {
                this.isOpen = !this.isOpen;
                if(this.isOpen) {
                    this.unreadCount = 0;
                    this.$nextTick(() => this.scrollToBottom());
                }
            },

            closeChat() {
                this.isOpen = false;
            },

            async sendMessage() {
                let msgText = this.userInput.trim();
                if (!msgText) return;

                this.messages.push({ 
                    sender: 'user', 
                    message: msgText,
                    time: this.getCurrentTime()
                });
                
                this.userInput = '';
                this.isTyping = true;
                this.$nextTick(() => this.scrollToBottom());

                try {
                    let res = await fetch('/chatbot/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ 
                            message: msgText, 
                            lead_id: this.leadId
                        })
                    });
                    
                    let data = await res.json();

                    if(data.lead_id) this.leadId = data.lead_id;

                    setTimeout(() => {
                        this.isTyping = false;
                        
                        this.messages.push({ 
                            sender: 'bot', 
                            message: data.reply || data.response, 
                            time: this.getCurrentTime()
                        });
                        
                        this.playNotification();
                        
                        if (!this.isOpen) this.unreadCount++;
                        
                        this.$nextTick(() => this.scrollToBottom());
                    }, 800);

                } catch (e) {
                    this.isTyping = false;
                    this.messages.push({ 
                        sender: 'bot', 
                        message: 'Maaf, jaringan sedang bermasalah.',
                        time: this.getCurrentTime()
                    });
                    this.$nextTick(() => this.scrollToBottom());
                }
            },

            playNotification() {
                if (this.playNotificationSound) {
                    this.playNotificationSound();
                }
            },

            scrollToBottom() {
                const el = document.getElementById('chat-scroll-area');
                if (el) {
                    el.scrollTo({
                        top: el.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }
        }));
    });
</script>