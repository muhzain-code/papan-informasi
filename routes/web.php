<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AgendaController;

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
        Route::resource('schedules', ScheduleController::class);
        Route::Resource('courses', CourseController::class);
        Route::Resource('rooms', RoomController::class);
        Route::Resource('lecturers', LecturerController::class);

        Route::resource('users', UserController::class);

        
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
        Route::get('/activity-log/{id}', [ActivityController::class, 'show'])->name('activity.show');
    });

Route::get('/', [HomeController::class, 'index'])->name('home');
