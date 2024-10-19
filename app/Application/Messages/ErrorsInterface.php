<?php

namespace App\Application\Messages;

interface ErrorsInterface
{
    public static function store(array $errors): void;

    public static function list(): array;

    public static function has(string $key, string $rule = ''): bool;

    public static function getMessage(string $key, bool $all = false): string|array|null;

    public static function clear(): void;
}