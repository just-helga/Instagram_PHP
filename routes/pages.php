<?php

use App\Application\Router\Route;
use App\Controllers\PageController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

Route::page('/', PageController::class, 'index', );

Route::page('/login', PageController::class, 'login', GuestMiddleware::class);
Route::page('/register', PageController::class, 'register', GuestMiddleware::class);

Route::page('/profile', PageController::class, 'profile', AuthMiddleware::class);

Route::page('/publish', PageController::class, 'publish');