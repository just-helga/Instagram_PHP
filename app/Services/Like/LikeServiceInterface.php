<?php

namespace App\Services\Like;

interface LikeServiceInterface
{
    public function store(array $data): void;
}