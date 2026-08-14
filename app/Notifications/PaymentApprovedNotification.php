<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class PaymentApprovedNotification extends Notification
{
    use Queueable;

    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Pembayaran Berhasil!',
            'message' => "Pembayaran untuk tagihan {$this->order->invoice_number} telah berhasil dikonfirmasi. Layanan Anda sedang diproses.",
            'icon' => 'ri-secure-payment-line',
            'color' => 'text-emerald-500',
            'bg_color' => 'bg-emerald-50',
            'link' => route('client.invoices')
        ];
    }
}
