<?php

namespace App\Core\Http;

class Request
{
    protected array $get;
    protected array $post;
    protected array $request;

    public function __construct()
    {
        $this->get = $this->sanitize($_GET);
        $this->post = $this->sanitize($_POST);
        $this->request = $this->sanitize($_REQUEST);
    }

    protected function sanitize(array $data): array
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return $this->sanitize($value);
            }

            // Trim and escape basic HTML special chars
            return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    public function input(string $key, $default = null)
    {
        return $this->request[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function query(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->request;
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
