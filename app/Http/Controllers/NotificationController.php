<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua notifikasi
        $notifications = $user->notifications;

        // Kelompokkan berdasarkan Tanggal (Y-m-d)
        // Hasilnya: ['2023-12-03' => [notif1, notif2], '2023-12-02' => [notif3]]
        $groupedNotifications = $notifications->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        return view('notifications.index', compact('groupedNotifications'));
    }

    // Mark as read (sudah ada sebelumnya di closure route, kita pindah kesini agar rapi)
    public function markRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->noContent();
    }
}