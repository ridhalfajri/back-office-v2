<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\PresensiHelper;

class CronGetDataPresensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cron-get-data-presensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data presensi pegawai';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        PresensiHelper::CronJobRunGetPresensi();
        // Jalankan Cronjob setiap menit
        $time = now()->format('H:i');
        if ($time == "20:00"){
            //Cronjob untuk mengecheck pegawai yang tidak melakukan presensi
             PresensiHelper::CronJobRunNoAbsenOrHoliday();
        }
        $this->info('Prosedure untuk mendapatkan data presensi berhasil dijalankan!');
    }
}
