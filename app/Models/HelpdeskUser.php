<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class HelpdeskUser extends Authenticatable
{
    protected $fillable = [
        'user_id',
        'license_key',
        'name',
        'email',
        'password',
        'avatar',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
