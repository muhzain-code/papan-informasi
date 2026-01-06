<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JadwalController;

Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'index']);
    Route::get('/last-sync', [JadwalController::class, 'lastSync']);
    Route::get('/stats', [JadwalController::class, 'stats']);
    Route::get('/filters', [JadwalController::class, 'filters']);
    Route::post('/sync', [JadwalController::class, 'sync'])->middleware('auth');
});
