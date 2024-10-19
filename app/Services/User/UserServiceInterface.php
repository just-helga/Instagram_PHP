<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function register(array $data): void;

    public function login(string $username, string $password): bool;

    public function logout(): void;

    public function update(array $image): void;
}