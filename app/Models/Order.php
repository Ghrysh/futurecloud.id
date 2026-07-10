<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function cleanUpExpired()
    {
        // Hapus order pending yang umurnya lebih dari 24 jam
        self::where('status', 'pending')
            ->where('created_at', '<', now()->subHours(24))
            ->delete();
    }
}