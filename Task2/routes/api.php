<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CountryController;

 Route::get('/user', function (Request $request) {
  return $request->user();
 })->middleware('auth:sanctum');

// Route::get('/', function(){
//     return'API';
// });
// Route::post('/auth/register', [UserController::class, 'createUser']);
// Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::apiResource('posts', PostController::class);

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('countries', CountryController::class)->except(['show']);
});
