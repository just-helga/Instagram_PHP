<?php

namespace App\Controllers;

use App\Application\Auth\Auth;
use App\Application\Helpers\Random;
use App\Application\Messages\Alert;
use App\Application\Messages\Error;
use App\Application\Messages\FormData;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Models\User;
use App\Services\User\UserService;

class UserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function register(Request $request): void
    {
        $request->validation([
            'email' => ['required', 'email', 'unique'],
            'name' => ['required', 'regex:/^[a-zA-Z0-9_-]+$/', 'unique'],
            'password' => ['required', 'min:6', 'max:30', 'confirm'],
            'password_confirmation' => ['required']
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Check the correctness of the filled in fields', 'danger');
            FormData::store($request->getData('posts'));
            Redirect::to('/register');
            die();
        }

        $this->service->register($request->getData('posts'));

        Alert::storeMessage('Registration was successful!', 'success');
        Redirect::to('/login');
    }

    public function login(Request $request): void
    {
        $request->validation([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Check the correctness of the filled in fields', 'danger');
            FormData::store($request->getData('posts'));
            Redirect::to('/login');
            die();
        }

        $auth = $this->service->login(
            $request->post('name'),
            $request->post('password')
        );

        if (!$auth) {
            Redirect::to('/login');
        } else {
            Redirect::to('/profile');
        }
    }

    public function logout()
    {
        $this->service->logout();
    }

    public function download(Request $request)
    {
        $this->service->update($request->file('image'));
        Alert::storeMessage('The avatar has been successfully installed', 'success');
        Redirect::to('/profile');
    }
}