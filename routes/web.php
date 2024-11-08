<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/dashboard', function () {
    return view('pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(
    [
        'middleware' => LocaleMiddleware::class,
        'prefix' => LocaleMiddleware::getLocale(),
    ],
    function () {
        Route::get('locale/{locale}', LocaleController::class)->name('change-locale');
        Route::get('/', [HomeController::class, 'index'])->name('home');
    }
);

require __DIR__.'/auth.php';
require __DIR__.'/socialstream.php';
