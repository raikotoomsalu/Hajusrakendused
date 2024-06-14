<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\isShopController;
use App\Http\Controllers\ProfileController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    Cache::remember('weather', now()->addHour(), fn () => Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'q' => 'Kuressaare',
        'appId' => 'fd58ec2777db435cfa40c95ef6e0f73a',
        'units' => 'metric'
    ])->json());
    
    return Inertia::render('Dashboard', [
        'weatherData' => Cache::get('weather'),
        'blogs' => Blog::with('comments')->get(),
        'users' => User::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('shop', isShopController::class);

Route::get('/Maps', function () {
    return Inertia::render('Radar/Maps');
})->middleware(['auth', 'verified'])->name('maps');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('blog', BlogController::class)->except('update');
    Route::post('blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update');

});

Route::resource('comment', CommentController::class)->except('update');
Route::post('comment/update/{comment}', [CommentController::class, 'update'])->name('comment.update');

Route::get('/API', function () {
    return Inertia::render('Api');
})->middleware(['auth:sanctum', 'verified'])->name('api');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
