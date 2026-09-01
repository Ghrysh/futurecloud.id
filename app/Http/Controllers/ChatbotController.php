<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotLead;
use App\Models\Product;
use App\Models\SaasProduct;
use App\Models\ChatbotKnowledge;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function processChat(Request $request)
    {
        // Override batas maksimal eksekusi PHP karena generate teks dari Ollama di CPU bisa lama
        ini_set('max_execution_time', 300);

        $topic = $request->topic ?? 'Umum'; 
        $rawMessage = strtolower(trim($request->message));
        $originalMessage = trim($request->message);

        // 1. DICTIONARY SLANG
        $slangDict = [
            'gmn' => 'bagaimana', 'gimana' => 'bagaimana', 'bgmn' => 'bagaimana', 'gmna' => 'bagaimana',
            'brp' => 'berapa', 'brapa' => 'berapa', 'brpa' => 'berapa', 'brap' => 'berapa', 'piro' => 'berapa',
            'klo' => 'kalau', 'kalo' => 'kalau', 'klau' => 'kalau',
            'bikin' => 'buat', 'bs' => 'bisa', 'gk' => 'tidak', 'ga' => 'tidak', 'gak' => 'tidak', 'ngga' => 'tidak', 'nggak' => 'tidak',
            'tdk' => 'tidak', 'dgn' => 'dengan', 'yg' => 'yang', 'utk' => 'untuk',
            'makasih' => 'terimakasih', 'trims' => 'terimakasih', 'thx' => 'terimakasih', 'mksh' => 'terimakasih',
            'pw' => 'password', 'pass' => 'password', 'loginnya' => 'login',
            'hrga' => 'harga', 'hrg' => 'harga', 'haarga' => 'harga', 'harg' => 'harga',
            'pket' => 'paket', 'pkt' => 'paket', 'pakat' => 'paket', 'pakt' => 'paket',
            'dpt' => 'dapat', 'dapet' => 'dapat', 'dapetnya' => 'dapat', 'dptnya' => 'dapat',
            'aja' => 'saja', 'sja' => 'saja', 'doang' => 'saja',
            'gartis' => 'gratis', 'grts' => 'gratis', 'free' => 'gratis', 'gratisan' => 'gratis', 'gretong' => 'gratis',
            'pmoela' => 'pemula', 'pmula' => 'pemula', 'pemola' => 'pemula', 'pmla' => 'pemula', 'pemulaa' => 'pemula', 'mula' => 'pemula',
            'propesional' => 'profesional', 'pro' => 'profesional', 'profesinal' => 'profesional', 'prfessional' => 'profesional', 'ptofesional' => 'profesional',
            'bisns' => 'bisnis', 'bsnis' => 'bisnis', 'bsns' => 'bisnis', 'bussines' => 'bisnis', 'business' => 'bisnis', 'biznis' => 'bisnis',
            'ftr' => 'fitur', 'isinya' => 'fitur', 'fasilitas' => 'fitur',
            'bda' => 'beda', 'bdanya' => 'beda', 'bedanya' => 'beda', 'perbedaan' => 'beda'
        ];

        // 2. CLEANSING PESAN UNTUK PENCOCOKAN KEYWORD (Pesan asli tetap disimpan di $originalMessage)
        $cleanMessage = preg_replace('/[^\w\s]/', '', $rawMessage);
        $words = explode(' ', $cleanMessage);
        foreach($words as &$w) {
            if(isset($slangDict[$w])) $w = $slangDict[$w];
        }
        $message = implode(' ', $words);

        // 3. GET IP & IDENTIFIKASI LEAD
        $realIp = $request->ip();
        if ($request->hasHeader('X-Forwarded-For')) {
            $ips = explode(',', $request->header('X-Forwarded-For'));
            $realIp = trim($ips[0]);
        }

        $lead = null;
        if ($request->lead_id) {
            $lead = ChatbotLead::find($request->lead_id);
        }

        // Jika Sedang Live Chat
        if ($lead && in_array($lead->live_chat_status, ['pending', 'active']) && !$request->is_autoclose) {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'user', 'text' => $originalMessage, 'time' => now()->format('d M, H:i')];
            $lead->update(['chat_history' => json_encode($history), 'last_message' => $originalMessage]);
            return response()->json(['reply' => null, 'lead_id' => $lead->id, 'show_live_chat_btn' => false]);
        }

        if ($request->is_autoclose) {
            if ($lead) {
                $contactInfo = auth()->check() ? auth()->user()->email : 'Diakhiri Otomatis (Guest)';
                $lead->update(['contact_info' => $contactInfo, 'chat_history' => json_encode($request->chat_history)]);
            }
            return response()->json(['success' => true]);
        }

        if (!$lead) {
            $lead = ChatbotLead::create([
                'user_id' => auth()->id(), 'ip_address' => $realIp, 'topic_context' => $topic,
                'contact_info' => '-', 'chat_history' => json_encode($request->chat_history), 'last_message' => $originalMessage
            ]);
        } else {
            $lead->update(['chat_history' => json_encode($request->chat_history), 'last_message' => $originalMessage]);
        }

        if ($request->is_followup) {
            $lead->update(['contact_info' => $originalMessage]);
            return response()->json([
                'reply' => 'Terima kasih! Tim Futurecloud akan segera menindaklanjuti kendala Anda melalui kontak tersebut. Sesi chat ini ditutup ya! 👋',
                'is_finished' => true, 'lead_id' => $lead->id
            ]);
        }

        // =========================================================================
        // 4. RULE-BASED FAST RESPONSE (Menangani Sapaan & Terima Kasih Tanpa AI)
        // =========================================================================
        
        // Cek Sapaan (Lebih fleksibel, tidak harus persis 1 kata. Max 4 kata agar "Halo mimin pagi" tetap masuk)
        if (preg_match('/\b(halo|hallo|hai|p|ping|pagi|siang|sore|malam|test|tes)\b/i', $cleanMessage) && str_word_count($cleanMessage) <= 4) {
            return response()->json([
                'reply' => 'Halo Kak! 👋 Ada yang bisa dibantu terkait Futurecloud?',
                'lead_id' => $lead->id,
                'show_live_chat_btn' => false
            ]);
        }

        // Cek Terima Kasih
        if (preg_match('/\b(makasih|terima kasih|terimakasih|thanks|thx|thank you|oke|ok|sip|baik|baiklah)\b/i', $cleanMessage) && str_word_count($cleanMessage) <= 5) {
            return response()->json([
                'reply' => 'Sama-sama Kak! 😊 Apakah ada hal lain yang bisa dibantu?',
                'lead_id' => $lead->id,
                'show_live_chat_btn' => false
            ]);
        }

        // =========================================================================
        // 5. PENYIAPAN KONTEKS & KNOWLEDGE UNTUK AI
        // =========================================================================

        $showLiveChatBtn = false;
        // PENTING: GANTI endpoint generate menjadi chat
        $ollamaUrl = env('OLLAMA_URL', 'http://ollama:11434/api/chat');

        $products = Product::with('features')->get();
        $saasProducts = SaasProduct::all();
        
        $allProductNames = array_merge(
            $products->pluck('name')->toArray(),
            $saasProducts->pluck('name')->toArray()
        );
        
        $isPricingTopic = ($topic === 'Paket & Pembayaran' || $topic === 'Produk');
        if (!$isPricingTopic) {
            $keywordsToCheck = array_merge(['produk', 'paket', 'harga', 'bayar', 'fitur', 'beda', 'gratis', 'saas', 'cloud', 'hosting', 'domain', 'vps'], array_map('strtolower', $allProductNames));
            foreach ($keywordsToCheck as $keyword) {
                if (str_contains($message, strtolower($keyword))) {
                    $isPricingTopic = true;
                    break;
                }
            }
        }

        // Siapkan System Prompt
        $systemContent = "Kamu adalah Asisten Virtual (Customer Service) dari Futurecloud yang ramah dan profesional. Selalu awali dengan sapaan 'Halo Kak'. Jawab dengan bahasa Indonesia yang santai tapi sopan. Jawablah secara singkat, maksimal 2-3 kalimat. PENTING: Jangan pernah copy-paste teks mentah. Kamu harus menyusun ulang jawaban dengan gaya bahasamu sendiri yang natural dan ramah, seolah-olah kamu benar-benar seorang CS yang memahami topiknya.\n\n";

        // ==== BARU: Cek Database Dulu ====
        $allowedTables = ['products', 'saas_products', 'chatbot_knowledges', 'users']; // Hardcoded for testing
        
        $dbDataJson = $this->queryDatabaseWithAi($allowedTables, $originalMessage);
        
        $dbContextForUser = false;
        if (!empty($dbDataJson) && strpos($dbDataJson, 'ERROR') === false && $dbDataJson !== '[]') {
            $dbContextForUser = true;
            \Illuminate\Support\Facades\Log::info("DEBUG DB DATA JSON: " . $dbDataJson);
        }
        // ==== AKHIR BARU ====

        if ($dbContextForUser) {
            $systemContent .= "Berikut adalah DATA DATABASE FUTURECLOUD sebagai referensi:\n" . $dbDataJson . "\n\nGunakan data di atas sebagai acuan untuk menjawab pertanyaan user secara spesifik. JANGAN ditambah/dikurang dan JANGAN diubah (misal 50000 jangan diubah jadi 500.000). Jika user meminta daftar seluruh item, sebutkan semua data di atas secara ringkas.";
        }
        else if ($isPricingTopic) {
            $dataPaketContext = "";
            
            // Loop Products (Domain, Hosting, VPS, etc.)
            foreach($products as $p) {
                $featuresList = $p->features->pluck('name')->toArray();
                $featuresStr = count($featuresList) > 0 ? implode(', ', $featuresList) : 'Standar fitur ' . $p->type;
                $dataPaketContext .= "- Produk {$p->name} ({$p->type}): Harga Rp" . number_format($p->price, 0, ',', '.') . "/{$p->cycle}, Fitur: {$featuresStr}.\n";
            }
            
            // Loop SaaS Products (Plugins, Addons, etc.)
            foreach($saasProducts as $sp) {
                $featuresStr = is_array($sp->features) ? implode(', ', $sp->features) : 'Standar SaaS';
                $dataPaketContext .= "- Plugin/SaaS {$sp->name}: Harga Rp" . number_format($sp->price, 0, ',', '.') . ", Fitur: {$featuresStr}.\n";
            }
            
            $systemContent .= "Berikut adalah DATA PRODUK & HARGA FUTURECLOUD sebagai referensi:\n{$dataPaketContext}\nGunakan data di atas sebagai acuan untuk menjawab. Jangan mengarang harga atau fitur yang tidak ada di daftar. Susun jawabanmu dengan gaya bahasa sendiri yang natural dan mudah dipahami. Jika user bertanya di luar produk/paket tersebut, sarankan untuk klik tombol Live Chat CS.";
        
        } else {
            // Pencarian Knowledge Base
            $knowledges = ChatbotKnowledge::all();
            $bestMatch = null;
            $highestScore = 0;

            foreach ($knowledges as $k) {
                $keywords = json_decode($k->keywords, true);
                $score = 0;
                foreach ($keywords as $kw) {
                    $kw = strtolower(trim($kw));
                    if (str_contains($message, $kw)) {
                        $score += strlen($kw) * 2; 
                    } else {
                        $kwWords = explode(' ', $kw);
                        foreach($kwWords as $kww) {
                            foreach($words as $userWord) {
                                if (strlen($userWord) > 3 && levenshtein($userWord, $kww) <= 1) {
                                    $score += 2;
                                }
                            }
                        }
                    }
                }
                if ($score > $highestScore) {
                    $highestScore = $score;
                    $bestMatch = $k;
                }
            }

            // Jika ada Knowledge yang cocok (Threshold score > 0)
            if ($bestMatch && $highestScore > 2) {
                $systemContent .= "Berikut adalah REFERENSI/SOP untuk menjawab pertanyaan user:\n" . $bestMatch->response . "\n\nGunakan informasi di atas sebagai panduan/referensi. JANGAN copy-paste teks di atas secara mentah. Susun ulang jawabanmu dengan gaya bahasamu sendiri yang natural, ramah, dan mudah dipahami oleh user. Jika informasi kurang jelas atau user bertanya hal di luar referensi, beritahu user untuk klik tombol Live Chat CS.";
            } else {
                // Jika tidak paham / Knowledge tidak ada
                $systemContent .= "Kamu TIDAK TAHU jawaban dari pertanyaan user karena tidak ada di database kamu. Tugasmu adalah meminta maaf dengan sopan, dan wajib mengarahkan user untuk menekan tombol 'Live Chat CS' agar bisa dibantu oleh agen manusia.";
                $showLiveChatBtn = true;
            }
        }

        // =========================================================================
        // 6. BUILD CHAT MESSAGES ARRAY (Sangat krusial untuk mencegah AI error)
        // =========================================================================
        $chatMessages = [];
        
        // A. Masukkan System Prompt
        $chatMessages[] = [
            'role' => 'system',
            'content' => $systemContent
        ];

        // B. Masukkan Chat History (Max 3 terakhir) agar AI paham konteks dialog
        $chatHistoryArr = json_decode($lead->chat_history, true) ?? [];
        $recentHistory = array_slice($chatHistoryArr, -3); 
        foreach ($recentHistory as $h) {
            $chatMessages[] = [
                'role' => ($h['sender'] === 'user') ? 'user' : 'assistant',
                'content' => $h['text']
            ];
        }

        // C. Masukkan Pesan User Saat Ini
        $chatMessages[] = [
            'role' => 'user',
            'content' => $originalMessage
        ];

        // =========================================================================
        // 7. REQUEST KE OLLAMA AI
        // =========================================================================
        $reply = "";
        try {
            // Naikkan timeout jadi 180 detik karena proses Ollama di CPU butuh waktu lama
            $llmResponse = Http::timeout(180)->post($ollamaUrl, [
                'model' => env('OLLAMA_MODEL', 'qwen2.5:1.5b'),
                'messages' => $chatMessages,
                'stream' => false,
                'max_tokens' => 300,
                'options' => [
                    'temperature' => 0.1,
                    'top_p' => 0.85,
                    'repeat_penalty' => 1.2
                ]
            ]);

            if ($llmResponse->successful()) {
                $aiText = trim($llmResponse->json('message.content'));
                $aiText = preg_replace('/^(aturan|rules|system|mimin:).*$/im', '', $aiText);
                $aiText = trim($aiText);
                if (!empty($aiText)) {
                    $reply = nl2br($aiText);
                }
            } else {
                throw new \Exception("LLM Error");
            }
        } catch (\Exception $e) {
            \Log::error('Chatbot Ollama Error: ' . $e->getMessage());
            if ($isPricingTopic) {
                $reply = "Halo Kak! 😊 AI kami sedang dalam proses restart. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat untuk info lebih cepat!";
            } else {
                // Fallback: tetap tampilkan knowledge mentah jika ada, tapi beri framing natural
                if (isset($bestMatch) && $bestMatch) {
                    $reply = "Halo Kak! 😊 " . $bestMatch->response;
                } else {
                    $reply = "Halo Kak, mohon maaf ya, AI kami sedang dalam proses restart. Apakah Kakak ingin terhubung dengan Tim Live Chat kami untuk dibantu langsung?";
                }
            }
            $showLiveChatBtn = true;
        }

        if (empty($reply)) {
            $reply = "Maaf Kak, kami sedang kesulitan memproses jawaban saat ini. Ingin terhubung dengan Tim CS / Admin (Live Chat)?";
            $showLiveChatBtn = true;
        }

        if (preg_match('/(live chat|agen manusia|cs|customer service|admin)/i', $reply)) {
            $showLiveChatBtn = true;
        }

        return response()->json([
            'reply' => $reply,
            'lead_id' => $lead->id,
            'show_live_chat_btn' => $showLiveChatBtn
        ]);
    }

    public function pollLiveChat($leadId) {
        $lead = ChatbotLead::find($leadId);
        return response()->json([
            'status' => $lead ? $lead->live_chat_status : 'none',
            'history' => $lead ? json_decode($lead->chat_history) : [],
            'admin_name' => ($lead && $lead->admin_id) ? \App\Models\Admin::find($lead->admin_id)->name : null
        ]);
    }

    public function sendLiveChatMessage(Request $request) {
        $lead = ChatbotLead::find($request->lead_id);
        if ($lead) {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'user', 'text' => $request->message, 'time' => now()->format('d M, H:i')];
            $lead->update(['chat_history' => json_encode($history)]);
        }
        return response()->json(['success' => true]);
    }

    public function requestLiveChat(Request $request)
    {
        $lead = null;
        
        if ($request->lead_id) {
            $lead = ChatbotLead::find($request->lead_id);
        }

        if (!$lead) {
            $realIp = $request->ip();
            if ($request->hasHeader('X-Forwarded-For')) {
                $ips = explode(',', $request->header('X-Forwarded-For'));
                $realIp = trim($ips[0]);
            }

            $lead = ChatbotLead::create([
                'user_id' => auth()->id(),
                'ip_address' => $realIp,
                'topic_context' => 'Live Chat',
                'contact_info' => '-',
                'chat_history' => json_encode([]),
                'last_message' => 'Meminta Live Chat',
                'live_chat_status' => 'pending'
            ]);
        } else {
            $lead->update([
                'live_chat_status' => 'pending'
            ]);
        }

        return response()->json([
            'success' => true,
            'lead_id' => $lead->id
        ]);
    }

    private function queryDatabaseWithAi(array $allowedTables, string $message)
    {
        $driver = config('database.default');
        
        // 2. Fetch schema for allowed tables
        $schemaText = "";
        try {
            foreach ($allowedTables as $table) {
                $columns = \Illuminate\Support\Facades\Schema::getColumns($table);
                
                $colDetails = [];
                foreach ($columns as $col) {
                    $colDetails[] = $col['name'] . " (" . $col['type_name'] . ")";
                }
                $schemaText .= "Table: $table\nColumns: " . implode(", ", $colDetails) . "\n\n";
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Schema Error: " . $e->getMessage());
            return "ERROR: Gagal membaca struktur database.";
        }

        // 3. Ask AI to generate SQL
        $apiUrl = env('AI_API_URL', env('OLLAMA_URL', 'http://ollama:11434/api/chat'));
        $model = env('AI_MODEL', env('OLLAMA_MODEL', 'qwen2.5:1.5b'));

        $promptSql = "You are a strict SQL generator. Based on this database schema:\n\n$schemaText\n\nUser Question: '$message'\n\nWrite ONLY a valid $driver SELECT query. \nYOU MUST OBEY THESE RULES OR THE SYSTEM WILL CRASH:\n1. Output ONLY the raw SQL. No markdown, no ```sql.\n2. YOU MUST USE `SELECT *`. DO NOT select specific columns like `SELECT price`.\n3. If the user asks for ALL items, DO NOT use a WHERE clause. If they ask for a specific item, use `LOWER(column) LIKE '%keyword%'`. NEVER use `=` for strings.\n\nEXAMPLES (Adapt to the provided schema!):\nUser: 'what items do you have / list all items / ada apa saja' -> SELECT * FROM [your_table_name];\nUser: 'how much is [specific_item]' -> SELECT * FROM [your_table_name] WHERE LOWER([item_column]) LIKE '%[specific_item]%';";

        $sqlQuery = "";
        try {
            $req = \Illuminate\Support\Facades\Http::timeout(300);
            $response = $req->post($apiUrl, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $promptSql]],
                'stream' => false,
                'max_tokens' => 100, // Cegah halusinasi kepanjangan
                'options' => [
                    'temperature' => 0.0, // Sangat deterministik
                ]
            ]);
            
            if ($response->successful()) {
                $sqlQuery = trim($response->json('message.content', ''));
                $sqlQuery = str_replace(['```sql', '```mysql', '```pgsql', '```'], '', $sqlQuery);
                $sqlQuery = trim($sqlQuery);
                \Illuminate\Support\Facades\Log::info("RAW SQL GENERATED: " . $sqlQuery);
            } else {
                return "ERROR: LLM API gagal (" . $response->status() . ").";
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("LLM Error: " . $e->getMessage());
            return "ERROR: Gagal menghubungi AI untuk generate SQL.";
        }

        // 4. Validasi minimal
        if (empty($sqlQuery) || stripos($sqlQuery, 'SELECT') !== 0) {
            return "ERROR: Query bukan SELECT yang valid.";
        }
        
        // 5. Execute SQL
        try {
            $results = \Illuminate\Support\Facades\DB::select($sqlQuery);
            $resultsArray = array_map(function($row) { return (array)$row; }, $results);
            
            if (empty($resultsArray)) {
                return "[]";
            }
            
            $textOutput = "";
            foreach ($resultsArray as $idx => $row) {
                if ($idx >= 5) {
                    $textOutput .= "... dan data lainnya.\n";
                    break;
                }
                $rowStrings = [];
                foreach ($row as $key => $val) {
                    $rowStrings[] = "$key: $val";
                }
                $textOutput .= "- " . implode(', ', $rowStrings) . "\n";
            }
            return trim($textOutput);
        } catch (\Exception $e) {
            return "ERROR: Gagal menjalankan query database.";
        }
    }
}