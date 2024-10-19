<?php

namespace App\Application\Request;

class Request implements RequestInterface
{
    use RequestValidation;

    private array $post;
    private array $get;
    private array $files;

    public function __construct(array $post, array $get, array $files)
    {
        $this->post = $post;
        $this->get = $get;
        $this->files = $files;
    }

    public function get(string $key): mixed
    {
        return $this->get[$key] ?? NULL;
    }

    public function post(string $key): mixed
    {
        return $this->post[$key] ?? NULL;
    }

    public function file(string $key): mixed
    {
        return $this->files[$key] ?? NULL;
    }

    public function validation(array $rules, array $warnings = []): array|bool
    {
        $data = $this->post;
        foreach ($this->files as $key => $file) {
            $data[$key] = $file;
        }
        return $this->validate(
            $data,
            $rules,
            $warnings
        );
    }

    public function getData(string $nameMethod): array
    {
        if ($nameMethod === 'posts') {
            return $this->post;
        }
        if ($nameMethod === 'get') {
            return $this->get;
        }
        if ($nameMethod === 'file') {
            return $this->files;
        }
    }
}