<?php

use App\Jobs\SyncJadwalDataJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Sync Jadwal data from UNUJA API every 3 hours
Schedule::job(new SyncJadwalDataJob())->everyThreeHours();

// Manual sync command
Artisan::command('sync:jadwal {semester?}', function (?string $semester = null) {
    $this->info('Starting Jadwal Kuliah sync...');
    
    SyncJadwalDataJob::dispatch($semester);
    
    $this->info('Sync job dispatched successfully!');
})->purpose('Manually trigger Jadwal Kuliah sync from UNUJA API');
