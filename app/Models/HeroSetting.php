<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagline', 
        'title', 
        'subtitle', 
        'background_images',
        'promo_image',
        'promo_url',
        'is_promo_active'
    ];

    protected $casts = [
        'background_images' => 'array', // Otomatis convert JSON ke Array
    ];
}