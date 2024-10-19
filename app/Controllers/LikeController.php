<?php

namespace App\Controllers;

use App\Application\Auth\Auth;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Like\LikeService;

class LikeController
{
    private LikeService $service;

    public function __construct()
    {
        $this->service = new LikeService();
    }

    public function put(Request $request): void
    {
        if (Auth::check()) {
            $data = [
                'post_id' => (int)$request->post('post_id')
            ];
            $this->service->store($data);
        } else {
            Redirect::to('/login');
        }
    }
}