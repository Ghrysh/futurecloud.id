<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SetAccountNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(#[\SensitiveParameter] $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('Atur Akun FutureCloud Anda'))
            ->greeting(Lang::get('Halo!'))
            ->line(Lang::get('Akun Anda belum memiliki username dan password karena didaftarkan melalui Google.'))
            ->line(Lang::get('Silakan klik tombol di bawah ini untuk mengatur akun Anda agar dapat login menggunakan email dan password.'))
            ->action(Lang::get('Set Account'), $url)
            ->line(Lang::get('Tautan ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Jika Anda tidak melakukan permintaan ini, abaikan saja email ini.'));
    }
}
