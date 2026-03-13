<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotLead;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function processChat(Request $request)
    {
        $topic = $request->topic ?? 'Umum'; 
        $message = strtolower(trim($request->message));
        $isInit = $request->is_init ?? false;
        $isFinished = $request->is_finished ?? false;
        
        $realIp = $request->ip();
        // Jika user tidak login, statusnya Guest beserta IP
        $contactInfo = Auth::check() ? Auth::user()->email : 'Guest - ' . $realIp;
        $userId = Auth::check() ? Auth::id() : null;

        // OTOMATIS CREATE/UPDATE KE DATABASE AGAR ADMIN BISA PANTAU REALTIME
        $lead = ChatbotLead::updateOrCreate(
            ['id' => $request->lead_id],
            [
                'user_id' => $userId,
                'ip_address' => $realIp,
                'topic_context' => $topic,
                'contact_info' => $contactInfo,
                'chat_history' => json_encode($request->chat_history),
                'last_message' => $request->message,
                'status' => $isFinished ? 'contacted' : 'pending' 
            ]
        );

        // Jika ini request awal saat klik tombol topik
        if ($isInit) {
            return response()->json([
                'reply' => "Baik, ada yang bisa saya bantu mengenai **{$topic}**?",
                'lead_id' => $lead->id
            ]);
        }

        // Jika user klik Akhiri & Hubungi CS
        if ($isFinished) {
            return response()->json([
                'reply' => 'Baik Kak, percakapan ini telah diteruskan ke Customer Service kami. Mohon tunggu sebentar, tim kami akan segera membalas pesan ini atau menghubungi Kakak.',
                'is_finished' => true,
                'lead_id' => $lead->id
            ]);
        }

        // === LOGIKA PENCOCOKAN KATA (SAMA SEPERTI SCANYUK) ===
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
            : "Maaf, pertanyaan Kakak kurang jelas untuk topik **".$topic."**. Boleh dijelaskan dengan kata kunci yang lebih spesifik?";

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