<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    /**
     * Logic inti untuk mengenali user.
     * Mengatasi masalah history hilang saat login atau pindah halaman.
     */
    private function getChatSession()
    {
        $sessionId = Session::getId();
        $user = Auth::user();

        if ($user) {
            // 1. JIKA USER LOGIN:
            // Cari history lama berdasarkan ID User, lalu update session_id ke yang baru.
            // Ini memastikan chat lama muncul kembali meski session browser berubah.
            return ChatSession::updateOrCreate(
                ['user_id' => $user->id], 
                [
                    'session_id' => $sessionId, 
                    'user_name' => $user->name
                ]
            );
        } else {
            // 2. JIKA GUEST:
            // Cari berdasarkan Session ID browser saat ini.
            return ChatSession::firstOrCreate(
                ['session_id' => $sessionId],
                ['user_name' => 'Guest']
            );
        }
    }

    /**
     * Menangani pengiriman pesan dari user dan memberikan balasan otomatis.
     */
    public function sendMessage(Request $request)
    {
        // 1. Ambil & Bersihkan Input
        $messageInput = strip_tags($request->input('message'));

        // 2. Dapatkan Sesi Chat yang Valid (Menggunakan fungsi helper di atas)
        $chatSession = $this->getChatSession();

        // 3. Simpan Pesan User ke Database
        ChatMessage::create([
            'chat_session_id' => $chatSession->id,
            'message' => $messageInput,
            'sender' => 'user'
        ]);

        // 4. LOGIKA PINTAR (Scoring System)
        // Mencari jawaban terbaik berdasarkan bobot kecocokan keyword
        $knowledge = ChatbotResponse::all();
        $bestMatch = null;
        $highestScore = 0;

        // Normalisasi input user (lowercase)
        $inputLower = strtolower($messageInput);

        foreach ($knowledge as $item) {
            // Pecah keyword dari database
            $keywords = array_map('trim', explode(',', strtolower($item->keyword)));
            $score = 0;

            foreach ($keywords as $keyword) {
                if (empty($keyword)) continue;

                // A. Exact Match (Skor Tinggi: 10 + Panjang Keyword)
                if (str_contains($inputLower, $keyword)) {
                    $score += 10 + strlen($keyword);
                }

                // B. Partial Match per Kata (Skor Rendah: 2)
                $words = explode(' ', $keyword);
                foreach ($words as $word) {
                    if (strlen($word) > 3 && str_contains($inputLower, $word)) {
                        $score += 2;
                    }
                }
            }

            // Update jawaban jika skor lebih tinggi ditemukan
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $item;
            }
        }

        // 5. Tentukan Jawaban Akhir
        if ($bestMatch && $highestScore >= 5) {
            $botAnswer = $bestMatch->answer;
        } else {
            // Fallback jika bot bingung
            $botAnswer = "Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?";
        }

        // 6. Personalisasi (Ganti placeholder {name} dengan nama user)
        $userName = Auth::check() ? Auth::user()->name : 'Guest';
        $botAnswer = str_replace('{name}', "<b>$userName</b>", $botAnswer);

        // 7. Simpan Jawaban Bot ke Database
        $botMessage = ChatMessage::create([
            'chat_session_id' => $chatSession->id,
            'message' => $botAnswer,
            'sender' => 'bot'
        ]);

        // 8. Kirim Response JSON (Termasuk Waktu)
        return response()->json([
            'reply' => $botAnswer,
            'time'  => $botMessage->created_at->format('H:i')
        ]);
    }

    /**
     * Mengambil riwayat chat saat halaman di-load.
     */
    public function getHistory()
    {
        // Panggil helper yang sama agar data konsisten
        $session = $this->getChatSession();

        if ($session) {
            // Mapping data agar format waktunya sesuai (H:i)
            $messages = $session->messages->map(function ($msg) {
                return [
                    'sender'  => $msg->sender,
                    'message' => $msg->message,
                    'time'    => $msg->created_at->format('H:i')
                ];
            });
            return response()->json($messages);
        }

        return response()->json([]);
    }
}