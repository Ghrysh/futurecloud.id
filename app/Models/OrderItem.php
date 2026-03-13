<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Casting agar kolom configuration otomatis jadi Array saat diambil
    protected $casts = [
        'configuration' => 'array',
    ];

    // === TAMBAHKAN CODE INI ===
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // ==========================
}