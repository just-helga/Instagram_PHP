<?php

namespace App\Middleware;

use App\Application\Auth\Auth;
use App\Application\Router\Redirect;

class AuthMiddleware
{
    public function handle() {
        if (!Auth::check()) {
            Redirect::to('/login');
        }
    }
}