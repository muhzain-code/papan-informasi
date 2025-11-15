<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AgendaController;

// ========== AUTH ==========
require __DIR__ . '/auth.php';

// ========== PROFILE (protected) ==========
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== ADMIN AREA (protected) ==========
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('news', NewsController::class);
         Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('news.publish');
        Route::post('news/{news}/draft', [NewsController::class, 'draft'])->name('news.draft');
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('infos', InfoController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('schedules', ScheduleController::class);

        //activity
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
        Route::get('/activity-log/{id}', [ActivityController::class, 'show'])->name('activity.show');
    });

// ========== FRONTEND ==========
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('berita', [BlogController::class, 'index'])->name('blog.index');
// Route::get('berita/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');
// Route::get('agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');

// Route::view('tentang', 'frontend.about.about')->name('about');
// Route::view('kontak', 'frontend.contact.contact')->name('contact');
