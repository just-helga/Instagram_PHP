<?php

namespace App\Services\User;

use App\Application\Auth\Auth;
use App\Application\Config\Config;
use App\Application\Helpers\Random;
use App\Application\Messages\Alert;
use App\Application\Messages\FormData;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Application\Upload\Upload;
use App\Models\Post;
use App\Models\User;

class UserService implements UserServiceInterface
{

    public function register(array $data): void
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->store();
    }

    public function login(string $username, string $password): bool
    {
        $user = new User();
        $user = $user->find(Config::get('auth.username_column'), $username);
        if (!$user) {
            Alert::storeMessage('User not found', 'danger');
            FormData::store([
                Config::get('auth.username_column') => $username,
                'password' =>$password
            ]);
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            Alert::storeMessage('Invalid username or password', 'danger');
            FormData::store([
                Config::get('auth.username_column') => $username,
                'password' =>$password
            ]);
            return false;
        }

        $token = Random::str(50);
        setcookie(Auth::getTokenColumn(), $token);
        $user->update([Auth::getTokenColumn() => $token]);
        return true;
    }

    public function logout(): void
    {
        unset($_SERVER[Auth::getTokenColumn()]);
        setcookie('token', NULL);
        Redirect::to('/login');
    }

    public function update(array $image): void
    {
        if ($image = Upload::file($image, 'avatars')) {
            $user = Auth::user();
            $user->setAvatar($image);
            $user->update(['avatar' => $image]);
        } else {
            Alert::storeMessage('Error uploading the file');
            Redirect::to('/profile');
        }
    }
}