<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API route is working']);
});
Route::get('/character/short/{id}',[ApiController::class, 'characterShort']);
Route::get('/character/list/{id}',[ApiController::class, 'characterList']);
Route::put('/character/{id}',[ApiController::class, 'characterEdit']);
