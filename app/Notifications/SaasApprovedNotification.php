<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SaasApprovedNotification extends Notification
{
    use Queueable;

    private $appName;

    public function __construct($appName)
    {
        $this->appName = $appName;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke database saja
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Aplikasi Disetujui!',
            'message' => "Aplikasi '{$this->appName}' Anda telah disetujui dan kini tayang di marketplace.",
            'icon' => 'ri-checkbox-circle-fill',
            'color' => 'text-green-500',
            
            // PERBAIKAN DI SINI: Ubah 'saas.index' menjadi 'saas.detail'
            'link' => route('saas.detail') 
        ];
    }
}