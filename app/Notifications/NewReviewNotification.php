<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReviewNotification extends Notification
{
    use Queueable;

    private $reviewerName;
    private $appName;
    private $rating;
    private $comment;
    private $appSlug;

    public function __construct($reviewerName, $appName, $rating, $comment, $appSlug)
    {
        $this->reviewerName = $reviewerName;
        $this->appName = $appName;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->appSlug = $appSlug;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Ulasan Baru Masuk',
            // Pesan: "Budi memberikan 5 Bintang untuk TaskFlow"
            'message' => "{$this->reviewerName} memberikan {$this->rating} bintang untuk {$this->appName}: \"". \Illuminate\Support\Str::limit($this->comment, 50) ."\"",
            'icon' => 'ri-star-smile-line',
            'color' => 'text-yellow-500',
            'link' => route('saas.show', $this->appSlug) // Link menuju halaman detail aplikasi
        ];
    }
}