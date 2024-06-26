<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingEntityController;
use App\Http\Controllers\BookingEntityObjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('booking-entities', BookingEntityController::class)->middleware('auth:sanctum');
Route::apiResource('booking-entity-objects', BookingEntityObjectController::class)->middleware('auth:sanctum');

Route::post('book', [BookingController::class, 'book'])->middleware('auth:sanctum');
