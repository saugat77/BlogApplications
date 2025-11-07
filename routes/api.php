<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('/logout', [LoginController::class, 'logout']);
});
