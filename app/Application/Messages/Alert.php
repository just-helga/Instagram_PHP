<?php

namespace App\Application\Messages;

class Alert implements AlertInterface
{
    public const DANGER = 'danger';
    public const SUCCESS = 'success';

    public static function storeMessage(string $message = 'Error', string $type = self::DANGER): void
    {
        setcookie("message", json_encode($message, JSON_UNESCAPED_UNICODE));
        setcookie("type_message", json_encode($type, JSON_UNESCAPED_UNICODE));
    }

    public static function getMessage(bool $clear = false): ?string
    {
        $message = $_COOKIE['message'] ?? NULL;
        if ($clear) {
            setcookie('message', '');
        }
        if (!empty($message)) {
            $message = substr($message, 1, length: -1);
        }
        return $message;
    }

    public static function getType(bool $clear = false): ?string
    {
        $type = $_COOKIE['type_message'] ?? NULL;
        if ($clear) {
            setcookie('type_message', '');
        }
        if (!empty($type)) {
            $type = substr($type, 1, length: -1);
        }
        return $type;
    }
}