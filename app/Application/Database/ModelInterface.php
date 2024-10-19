<?php

namespace App\Application\Database;

interface ModelInterface
{
    public function find(string $column, mixed $value, bool $many = false): array|bool|Model;

    public function all(): array;

    public function store(): void;

    public function update(array $data): void;

    public function destroy(string $column, mixed $value): void;
}