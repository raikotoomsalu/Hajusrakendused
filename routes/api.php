<?php

use App\Http\Controllers\GoogleMarkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/google-maps/markers', [GoogleMarkerController::class, 'index']);
Route::post('/google-maps/markers', [GoogleMarkerController::class, 'store']);
Route::put('/google-maps/markers/{id}', [GoogleMarkerController::class, 'update']);
Route::delete('/google-maps/markers/{id}', [GoogleMarkerController::class, 'destroy']);
