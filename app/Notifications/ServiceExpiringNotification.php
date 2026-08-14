<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\OrderItem;

class ServiceExpiringNotification extends Notification
{
    use Queueable;

    private $item;
    private $daysLeft;

    public function __construct(OrderItem $item, $daysLeft)
    {
        $this->item = $item;
        $this->daysLeft = $daysLeft;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $color = $this->daysLeft <= 3 ? 'text-red-500' : 'text-amber-500';
        $bgColor = $this->daysLeft <= 3 ? 'bg-red-50' : 'bg-amber-50';
        $icon = $this->daysLeft <= 3 ? 'ri-error-warning-fill' : 'ri-time-line';
        
        return [
            'title' => 'Layanan Akan Berakhir',
            'message' => "Layanan {$this->item->product_name} Anda akan berakhir dalam {$this->daysLeft} hari. Segera perpanjang untuk menghindari gangguan layanan.",
            'icon' => $icon,
            'color' => $color,
            'bg_color' => $bgColor,
            'link' => route('client.services')
        ];
    }
}
