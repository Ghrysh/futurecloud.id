<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SaasRejectedNotification extends Notification
{
    use Queueable;

    private $appName;
    private $reason;

    public function __construct($appName, $reason)
    {
        $this->appName = $appName;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Aplikasi Ditolak/Dihapus',
            'message' => "Aplikasi '{$this->appName}' tidak disetujui atau dihapus oleh Admin. Alasan: {$this->reason}",
            'icon' => 'ri-close-circle-fill',
            'color' => 'text-red-500',
            'link' => url('/contact') // Arahkan ke halaman contact (meski belum ada, route-nya biasanya /contact)
        ];
    }
}