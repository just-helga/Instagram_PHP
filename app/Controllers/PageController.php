<?php

namespace App\Controllers;
use App\Application\Views\View;

class PageController
{
    public function index(): void
    {
        View::show('pages/index', [
            'title' => 'Main'
        ]);
    }

    public function login(): void
    {
        View::show('pages/login', [
            'title' => 'Login'
        ]);
    }

    public function register(): void
    {
        View::show('pages/register', [
            'title' => 'Registration'
        ]);
    }

    public function profile(): void
    {
        View::show('pages/profile', [
            'title' => 'Profile'
        ]);
    }

    public function publish(): void
    {
        View::show('pages/publish', [
            'title' => 'New Post'
        ]);
    }
}