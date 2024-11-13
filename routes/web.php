<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
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
        Route::get('/race/{id}', [InfoController::class, 'showRace'])->name('race.show');
        Route::get('/class/{id}', [InfoController::class, 'showClass'])->name('class.show');
        Route::get('/alignments', [InfoController::class, 'alignments'])->name('alignments');
        Route::get('/backgrounds', [InfoController::class, 'backgrounds'])->name('backgrounds');
        Route::get('/weapons', [InfoController::class, 'weapons'])->name('weapons');
        Route::get('/spells', [InfoController::class, 'spells'])->name('spells');
        Route::get('/abilities', [InfoController::class, 'abilities'])->name('abilities');
        Route::get('/streams', [HomeController::class, 'streams'])->name('streams');
        Route::get('/details', [HomeController::class, 'details'])->name('details');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    }
);

Route::get('/characters/{id}', [HomeController::class, 'character'])->name('characters.show');

require __DIR__.'/auth.php';
require __DIR__.'/socialstream.php';
