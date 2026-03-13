<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaasReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'saas_slug',
        'rating',
        'comment',
    ];

    // Relasi ke User (untuk ambil nama & foto)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}