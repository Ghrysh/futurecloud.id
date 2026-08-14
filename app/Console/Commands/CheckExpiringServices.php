<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\ServiceExpiringNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckExpiringServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiring-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for services that are about to expire and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Mulai mengecek layanan yang akan expired...");
        
        // Ambil order yang sudah dibayar
        $orders = Order::with(['items', 'user'])->where('status', 'paid')->whereNotNull('paid_at')->get();
        
        $notifiedCount = 0;

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $expiredAt = null;
                $config = is_string($item->configuration) ? json_decode($item->configuration, true) : $item->configuration;
                
                // Jika plugin dan ada expired_at di konfigurasi
                if (isset($config['expired_at'])) {
                    $expiredAt = Carbon::parse($config['expired_at']);
                } else {
                    // Kalkulasi berdasarkan paid_at dan billing_cycle
                    $paidAt = Carbon::parse($order->paid_at);
                    if ($item->billing_cycle === 'monthly') {
                        $expiredAt = $paidAt->copy()->addMonth();
                    } elseif ($item->billing_cycle === 'annually') {
                        $expiredAt = $paidAt->copy()->addYear();
                    }
                }

                if ($expiredAt) {
                    $daysLeft = Carbon::now()->diffInDays($expiredAt, false); // false untuk hitungan negatif jika sudah lewat
                    
                    // Kita hanya kirim notif jika H-7 atau H-3
                    // Untuk menyederhanakan, kita asumsikan cron berjalan 1 hari sekali.
                    // Jika daysLeft adalah 7 atau 3
                    if ($daysLeft === 7 || $daysLeft === 3) {
                        Log::info("Mengirim notifikasi expired ke {$order->user->name} untuk {$item->product_name}. Sisa: {$daysLeft} hari.");
                        $order->user->notify(new ServiceExpiringNotification($item, $daysLeft));
                        $notifiedCount++;
                    }
                }
            }
        }
        
        Log::info("Selesai mengecek layanan. Total notifikasi terkirim: {$notifiedCount}");
        $this->info("Pengecekan selesai. {$notifiedCount} notifikasi terkirim.");
    }
}
