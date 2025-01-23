<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CountryController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::resource('countries', CountryController::class)->except(['show']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('admin/profile', [AdminController::class, 'profile']);
});
