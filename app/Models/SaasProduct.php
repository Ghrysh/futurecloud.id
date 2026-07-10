<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaasProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug', 'category', 'tagline', 
        'description', 'price', 'thumbnail', 'status',
        'features', 'plans'
    ];

    protected $guarded = [];

    // === TAMBAHKAN INI ===
    protected $casts = [
        'plans' => 'array',
        'features' => 'array', // Ini memberitahu Laravel: "Ubah Array ke JSON saat simpan, dan JSON ke Array saat ambil"
    ];

    // Relasi ke User (Partner)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}