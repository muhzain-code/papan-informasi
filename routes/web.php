<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Frontend\AgendaController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Event;

Route::get('/dashboard', function () {
    return view('Home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('Home.index');
    })->name('admin.index');

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('admin.pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('admin.pages.store');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('admin.pages.update');
    Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
    Route::get('/pages/{page}', [PageController::class, 'show'])->name('admin.pages.show');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('admin.news.show');

    Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('admin.news.publish');
    Route::post('news/{news}/draft', [NewsController::class, 'draft'])->name('admin.news.draft');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('admin.events.show');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('admin.settings.store');
    Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('admin.settings.update');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('admin.settings.destroy');
});

// beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// berita
Route::get('berita', [BlogController::class, 'index'])->name('blog.index');
Route::get('berita/{slug}', [BlogController::class, 'show'])->name('blog.show');

// agenda
Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');

//about
Route::get('tentang', function () {
    return view('frontend.about.about');
})->name('about');

//about
Route::get('kontak', function () {
    return view('frontend.contact.contact');
})->name('contact');
