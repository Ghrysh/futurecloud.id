<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'invoice_no',   // Nomor unik invoice (INV-XXXX)
        'description',  // Keterangan pembelian
        'amount',       // Total harga
        'status',       // Paid, Unpaid, Cancelled
    ];

    /**
     * Konversi tipe data otomatis.
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Relasi ke User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}