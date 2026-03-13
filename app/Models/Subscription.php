<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'type',         // hosting, domain, vps
        'name',         // Nama paket atau nama domain
        'price',
        'reg_date',     // Tanggal daftar
        'due_date',     // Tanggal jatuh tempo
        'ip_address',
        'status',       // Active, Suspended, Cancelled
    ];

    /**
     * Konversi tipe data otomatis.
     */
    protected $casts = [
        'reg_date' => 'date',
        'due_date' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * Relasi ke User (Milik siapa subscription ini).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}