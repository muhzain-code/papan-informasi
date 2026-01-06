<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Frontend\HomeController;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('news', NewsController::class);
        Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('news.publish');
        Route::post('news/{news}/draft', [NewsController::class, 'draft'])->name('news.draft');
        
        Route::resource('announcements', AnnouncementController::class);
        Route::post('/announcements/{announcement}/publish', [AnnouncementController::class, 'publish'])
            ->name('announcements.publish');
        Route::post('/announcements/{announcement}/draft', [AnnouncementController::class, 'draft'])
            ->name('announcements.draft');

        Route::resource('infos', InfoController::class);
        Route::resource('videos', VideoController::class);

        Route::resource('users', UserController::class);
        Route::resource('notifications', NotificationController::class);

        Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
        Route::get('/activity-log/{id}', [ActivityController::class, 'show'])->name('activity.show');

        // Jadwal Kuliah (from UNUJA API)
        Route::get('/jadwal', [\App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/jadwal/{jadwal}', [\App\Http\Controllers\Admin\JadwalController::class, 'show'])->name('jadwal.show');
        Route::post('/jadwal/sync', [\App\Http\Controllers\Admin\JadwalController::class, 'sync'])->name('jadwal.sync');
    });

Route::get('/', [HomeController::class, 'index'])->name('home');
