<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    // Pastikan 'sender' ada di sini
    protected $fillable = [
        'chat_session_id', 
        'message', 
        'sender' // <--- WAJIB ADA
    ];

    public function session()
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }
}