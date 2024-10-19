<?php

namespace App\Models;

use App\Application\Database\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $fields = ['email', 'name', 'avatar', 'password', 'token'];

    protected string $email;
    protected string $name;
    protected string $password;
    protected ?string $token;
    protected ?string $avatar;

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getCreatedAt(): string
    {
        $date = date("d-m-Y", strtotime($this->created_at));
        return $date;
    }
}