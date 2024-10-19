<?php

use App\Application\Router\Route;
use App\Controllers\LikeController;
use App\Controllers\PostController;
use App\Controllers\UserController;

Route::post('/register', UserController::class, 'register');
Route::post('/login', UserController::class, 'login');

Route::post('/logout', UserController::class, 'logout');
Route::post('/download', UserController::class, 'download');

Route::post('/publish_save', PostController::class, 'store');
Route::post('/delete', PostController::class, 'destroy');

Route::post('/like', LikeController::class, 'put');