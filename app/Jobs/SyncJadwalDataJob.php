<?php

namespace App\Jobs;

use App\Services\UnujaApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncJadwalDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;
    public int $timeout = 300;

    protected string $semesterId;

    public function __construct(?string $semesterId = null)
    {
        $this->semesterId = $semesterId ?? '20251';
    }

    public function handle(UnujaApiService $apiService): void
    {
        Log::info('SyncJadwalDataJob: Starting sync...', ['semester' => $this->semesterId]);

        $result = $apiService->syncToDatabase($this->semesterId);

        if ($result['success']) {
            Log::info('SyncJadwalDataJob: Completed successfully', [
                'records' => $result['records_synced'],
            ]);
        } else {
            Log::error('SyncJadwalDataJob: Failed', [
                'error' => $result['error'],
            ]);

            if ($this->attempts() >= $this->tries) {
                Log::error('SyncJadwalDataJob: Max retries reached');
            }
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SyncJadwalDataJob: Job failed permanently', [
            'error' => $exception->getMessage(),
        ]);
    }
}
