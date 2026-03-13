<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi OTP Anda - FutureCloud.id',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Kita menggunakan view inline sederhana agar tidak perlu buat file blade baru
        // Jika ingin tampilan bagus, buat file di resources/views/emails/otp.blade.php
        return new Content(
            htmlString: '
                <div style="font-family: Arial, sans-serif; padding: 20px;">
                    <h2>Verifikasi Email Anda</h2>
                    <p>Halo,</p>
                    <p>Terima kasih telah mendaftar. Gunakan kode berikut untuk menyelesaikan pendaftaran:</p>
                    <h1 style="color: #2563eb; letter-spacing: 5px;">' . $this->otp . '</h1>
                    <p>Kode ini berlaku selama 5 menit.</p>
                    <p>Jika Anda tidak meminta kode ini, abaikan email ini.</p>
                </div>
            ',
        );
    }
}