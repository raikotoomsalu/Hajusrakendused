<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\GoogleMarkerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/google-maps/markers', [GoogleMarkerController::class, 'index']);
Route::post('/google-maps/markers', [GoogleMarkerController::class, 'store']);
Route::put('/google-maps/markers/{id}', [GoogleMarkerController::class, 'update']);
Route::delete('/google-maps/markers/{id}', [GoogleMarkerController::class, 'destroy']);

Route::get('/car', [CarController::class, 'index']);
Route::post('/car', [CarController::class, 'store']);
Route::put('/car/{car}', [CarController::class, 'update']);
Route::get('/car/{car}', [CarController::class, 'show']);
Route::delete('/car/{car}', [CarController::class, 'destroy']);

Route::get('/class', [ApiController::class, 'index']);

