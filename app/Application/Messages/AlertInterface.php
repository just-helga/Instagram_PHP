<?php

namespace App\Application\Messages;

interface AlertInterface
{
 public static function storeMessage(string $message, string $type = 'danger'): void;

 public static function getMessage(bool $clear = false): ?string;

 public static function getType(bool $clear = false): ?string;
}