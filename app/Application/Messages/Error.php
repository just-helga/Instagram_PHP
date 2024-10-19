<?php

namespace App\Application\Messages;

class Error implements ErrorsInterface
{
    private static array $errors;

    public static function store(array $errors): void
    {
        setcookie('errors', json_encode($errors, JSON_UNESCAPED_UNICODE));
    }

    public static function list(): array
    {
        if (!isset(self::$errors)) {
            self::$errors = isset($_COOKIE['errors']) ? json_decode($_COOKIE['errors'], true) : [];
        }
        return self::$errors;
    }

    public static function has(string $key, string $rule = ''): bool
    {
        if (empty($rule)) {
            return isset(self::list()[$key]);
        } else {
            return isset(self::list()[$key][$rule]);
        }
    }

    public static function getMessage(string $key, bool $all = false): string|array|null
    {
        if (isset(self::list()[$key])) {
            $errors = self::list()[$key];
            if ($all) {
                return $errors;
            } else {
                return reset($errors);
            }
        } else {
            return NULL;
        }
    }

    public static function clear(): void
    {
        setcookie('errors', '');
    }
}