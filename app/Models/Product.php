<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kita gunakan $fillable agar lebih aman dan eksplisit mencatat kolom apa saja yang ada
    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'price', 
        'type',           // domain, hosting, vps, saas
        'category',       // Popular, Business, dll
        'cycle',          // mo, yr
        'tag',            // Best Seller, Promo, dll
        'discount_config',// JSON Configuration
        'renew_price',    // Khusus Domain
        'transfer_price'  // Khusus Domain
    ];

    /**
     * Konversi data otomatis.
     * discount_config: JSON di DB -> Array di PHP.
     */
    protected $casts = [
        'discount_config' => 'array', // PENTING: Agar otomatis jadi array saat diakses
        'price' => 'decimal:0',       // Memastikan harga dianggap angka tanpa desimal (IDR)
        'renew_price' => 'decimal:0',
        'transfer_price' => 'decimal:0',
    ];

    // Relasi ke Fitur (Checklist)
    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }
}