<?php

namespace App\Application\Request;

interface RequestInterface
{
    public function get(string $key): mixed;

    public function post(string $key): mixed;

    public function file(string $key): mixed;

    public function validation(array $rules, array $warnings = []): array|bool;

    public function getData(string $nameMethod): array;
}