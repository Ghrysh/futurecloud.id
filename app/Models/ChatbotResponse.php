<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotResponse extends Model
{
    protected $fillable = ['keyword', 'answer', 'session_id', 'user_id', 'user_name'];
}
