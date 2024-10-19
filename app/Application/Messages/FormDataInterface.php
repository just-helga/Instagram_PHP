<?php

namespace App\Application\Messages;

interface FormDataInterface
{
    public static function store(array $data): void;

    public static function list(): array;

    public static function has(string $key): bool;

    public static function get(string $key): string|null;

    public static function clear(): void;
}