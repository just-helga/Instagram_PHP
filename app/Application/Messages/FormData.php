<?php

namespace App\Application\Messages;

class FormData implements FormDataInterface
{
    private static array $data;

    public static function store(array $data): void
    {
        setcookie("formdata", json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    public static function list(): array
    {
        if (!isset(self::$data)) {
            self::$data = isset($_COOKIE["formdata"]) ? json_decode($_COOKIE["formdata"], true) : [];
        }
        return self::$data;
    }

    public static function has(string $key): bool
    {
        return isset(self::list()[$key]);
    }

    public static function get(string $key): string|null
    {
        if (isset(self::list()[$key])) {
            $value = self::list()[$key];
            return $value;
        } else {
            return NULL;
        }
    }

    public static function clear(): void
    {
        setcookie('formdata', '');
    }
}