<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
         $schedule->call(function () {
            $jumlah = DB::table('validasi_logs')
                ->where('created_at', '<', Carbon::now()->subDays(30))
                ->delete();

            // Optional: log hasil penghapusan
            Log::info("Hapus otomatis: $jumlah data validasi_logs dihapus karena lebih dari 30 hari.");
        })->everyMinute(); // Jalankan setiap hari
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
