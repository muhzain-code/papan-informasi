<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Pages
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('pages', PageController::class);
});

Route::get('/pages/{page:slug}', [PageController::class, 'showPublic'])->name('pages.show');

// News
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('news', NewsController::class);
});

Route::get('/news/{news:slug}', [NewsController::class, 'showPublic'])->name('news.show');

//Event 
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
});

Route::get('/events/{event:slug}', [EventController::class, 'showPublic'])->name('events.show');

// Setting
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('settings', SettingController::class)->except(['show', 'create']);
});
