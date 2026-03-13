<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['name']), // Pengirim sesuai input user
            subject: '[FutureCloud] Pesan Baru: ' . $this->data['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // Kita akan buat view ini di langkah selanjutnya
        );
    }
}