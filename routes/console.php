<?php

use App\Services\UnujaApiService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Sync Jadwal data from UNUJA API every 3 hours (langsung tanpa job/queue)
Schedule::call(function () {
    $apiService = app(UnujaApiService::class);
    $result = $apiService->syncToDatabase();

    if ($result['success']) {
        Log::info('Schedule Sync Jadwal: Completed', ['records' => $result['records_synced']]);
    } else {
        Log::error('Schedule Sync Jadwal: Failed', ['error' => $result['error']]);
    }
})->everyThreeHours()->name('sync-jadwal-data');

// Manual sync command (langsung tanpa job/queue)
Artisan::command('sync:jadwal {semester?}', function (?string $semester = null) {
    $this->info('Starting Jadwal Kuliah sync...');

    $apiService = app(UnujaApiService::class);
    $result = $apiService->syncToDatabase($semester ?? '20251');

    if ($result['success']) {
        $this->info("Sync berhasil! {$result['records_synced']} jadwal tersinkronisasi.");
    } else {
        $this->error("Sync gagal: {$result['error']}");
    }
})->purpose('Manually trigger Jadwal Kuliah sync from UNUJA API');
