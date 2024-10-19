<?php

namespace App\Models;

use App\Application\Database\Model;

class Post extends Model
{
    protected string $table = 'posts';
    protected array $fields = ['image', 'description', 'user_id'];

    protected string $image;
    protected ?string $description;
    protected int $user_id;

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}