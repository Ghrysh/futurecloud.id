<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $email
 * @property string $avatar
 * @property string|null $google_id
 * @property string|null $github_id
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',   // Baru
        'first_name', // Baru
        'last_name',  // Baru
        'username',
        'name',       // Tetap ada (sebagai Display Name gabungan)
        'email',
        'password',
        'google_id',
        'avatar',
        'email_verified_at',
        'godaddy_shopper_id',
        'company_name', 'phone_number', 'address', 'role', 'partner_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor untuk URL Foto Profil.
     */
    public function getProfilePhotoUrlAttribute()
    {
         /** @var \App\Models\User $this */
         
        // 1. Jika ada avatar tersimpan di database (Login Google)
        if (!empty($this->avatar)) {
            return $this->avatar;
        }

        // 2. Cek Gravatar berdasarkan Email
        // Pastikan email dibersihkan (trim) dan dikecilkan (strtolower)
        $hash = md5(strtolower(trim($this->email)));
        
        // Parameter 'd=mp' artinya: Default = Mystery Person (Siluet User)
        return "https://www.gravatar.com/avatar/{$hash}?s=200&d=mp";
    }
}