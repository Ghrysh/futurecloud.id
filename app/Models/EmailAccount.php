<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAccount extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'email_accounts';

    /**
     * Mass assignable.
     */
    protected $fillable = [
        'email',
        'email_password',
        'imap_host',
        'imap_port',
        'imap_encryption',
        'imap_protocol',
        'imap_validate_cert',
        'smtp_host',
        'smtp_port',
        'smtp_encryption',
        'is_active',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [

        // Auto encrypt & decrypt
        'email_password' => 'encrypted',

        // Boolean casting
        'imap_validate_cert' => 'boolean',
        'is_active'          => 'boolean',
    ];
}