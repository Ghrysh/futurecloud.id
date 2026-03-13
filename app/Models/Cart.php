<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    // === TAMBAHKAN KODE DI BAWAH INI ===
    protected $casts = [
        'configuration' => 'array', // Ini akan otomatis mengubah JSON string menjadi Array
    ];
    // ====================================

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}