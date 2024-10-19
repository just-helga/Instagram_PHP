<?php

namespace App\Services\Post;

interface PostServiceInterface
{
    public function store(array $image, ?string $description): void;

    public function destroy(int $id): void;
}