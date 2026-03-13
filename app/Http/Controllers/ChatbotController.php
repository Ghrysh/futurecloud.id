<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotLead;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function initChat(Request $request)
    {
        $topics = ChatbotKnowledge::select('topic')->distinct()->pluck('topic');
        if ($topics->isEmpty()) {
            $topics = collect(['Umum', 'Layanan Cloud', 'Bantuan Teknis']);
        }
        return response()->json(['topics' => $topics]);
    }

    public function processChat(Request $request)
    {
        $topic = $request->topic ?? 'Umum'; 
        $message = strtolower(trim($request->message));
        
        $isInit = $request->is_init ?? false;
        $isAskingContact = $request->asking_contact ?? false;
        $isSubmittingContact = $request->submitting_contact ?? false;
        
        $realIp = $request->ip();
        $userId = Auth::check() ? Auth::id() : null;

        // Cari atau buat session realtime
        $lead = ChatbotLead::find($request->lead_id);
        
        if (!$lead) {
            $lead = ChatbotLead::create([
                'user_id' => $userId,
                'ip_address' => $realIp,
                'topic_context' => $topic,
                'chat_history' => json_encode($request->chat_history),
                'last_message' => $request->message,
                'status' => 'pending'
                // NOTE: contact_info sengaja TIDAK dimasukkan agar di DB kosong (null)
            ]);
        } else {
            $lead->update([
                'chat_history' => json_encode($request->chat_history),
                'last_message' => $request->message,
                'topic_context' => $topic
            ]);
        }

        if ($isInit) {
            return response()->json([
                'reply' => "Baik, ada yang bisa Mimin bantu mengenai {$topic}?",
                'lead_id' => $lead->id
            ]);
        }

        if ($isAskingContact) {
            return response()->json([
                'reply' => 'Baik Kak, percakapan ini akan kami teruskan ke Customer Service. Silakan ketik Email atau Nomor Telepon Kakak di bawah agar bisa kami hubungi secepatnya:',
                'lead_id' => $lead->id
            ]);
        }

        // HANYA saat user mengirim kontak, kolom contact_info akan diisi
        if ($isSubmittingContact) {
            $lead->update([
                'contact_info' => $request->message 
            ]);
            return response()->json([
                'reply' => 'Terima kasih! Kontak Kakak telah kami catat. Tim Customer Service kami akan segera menghubungi Anda. Percakapan ini telah diakhiri. 👋',
                'is_finished' => true,
                'lead_id' => $lead->id
            ]);
        }

        // === LOGIKA PENCOCOKAN KATA (UMUM) ===
        $slangDict = [
            'gmn' => 'bagaimana', 'gimana' => 'bagaimana', 'bgmn' => 'bagaimana',
            'brp' => 'berapa', 'klo' => 'kalau', 'kalo' => 'kalau',
            'bikin' => 'buat', 'bs' => 'bisa', 'gk' => 'tidak', 'ga' => 'tidak',
            'tdk' => 'tidak', 'dgn' => 'dengan', 'yg' => 'yang', 'utk' => 'untuk',
            'makasih' => 'terimakasih', 'trims' => 'terimakasih', 'thx' => 'terimakasih',
            'pw' => 'password', 'pass' => 'password', 'loginnya' => 'login'
        ];

        $cleanMessage = preg_replace('/[^\w\s]/', '', $message);
        $words = explode(' ', $cleanMessage);
        foreach($words as &$w) {
            if(isset($slangDict[$w])) $w = $slangDict[$w];
        }
        $cleanMessage = implode(' ', $words);

        $knowledges = ChatbotKnowledge::whereIn('topic', [$topic, 'Umum'])->get();
        $bestMatch = null;
        $highestScore = 0;

        foreach ($knowledges as $k) {
            $keywords = json_decode($k->keywords, true) ?? [];
            $score = 0;

            foreach ($keywords as $kw) {
                $kw = strtolower(trim($kw));
                if (str_contains($cleanMessage, $kw)) {
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

        $reply = $highestScore > 0 
            ? $bestMatch->response 
            : "Maaf, pertanyaan Kakak kurang jelas. Boleh dijelaskan dengan kata kunci yang lebih spesifik?";

        return response()->json([
            'reply' => $reply,
            'lead_id' => $lead->id
        ]);
    }

    public function getHistory(Request $request)
    {
        return response()->json([]);
    }
}