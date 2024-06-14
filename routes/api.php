<?php

use App\Http\Controllers\GoogleMarkerController;
use App\Http\Controllers\SongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/google-maps/markers', [GoogleMarkerController::class, 'index']);
Route::post('/google-maps/markers', [GoogleMarkerController::class, 'store']);
Route::put('/google-maps/markers/{id}', [GoogleMarkerController::class, 'update']);
Route::delete('/google-maps/markers/{id}', [GoogleMarkerController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/song', [SongController::class, 'index']);
Route::post('/song', [SongController::class, 'store']);
Route::get('/song/{song}', [SongController::class, 'show']);
Route::put('/song/{song}', [SongController::class, 'update']);
Route::delete('/song/{song}', [SongController::class, 'destroy']);