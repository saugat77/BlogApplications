<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [UserController::class, 'getUser']);

    Route::resource('/posts', PostController::class);

    Route::resource('/categories', CategoryController::class);
    Route::get('/category/all',[ CategoryController::class, 'fetchAllCategories']);

    Route::resource('/tags', TagController::class);
    Route::get('/tag/all', [TagController::class, 'fetchAllTags']);

    Route::post('/logout', [LoginController::class, 'logout']);
});
