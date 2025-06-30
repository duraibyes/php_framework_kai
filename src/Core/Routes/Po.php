<?php

namespace App\Core\Routes;

class Po
{
    private static array $routes = [];

    public static function addRoute(string $method, string $uri, callable|array $action): void
    {
        self::$routes[$method][$uri] = $action;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function get(string $uri, callable|array $action)
    {
        self::addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, callable|array $action)
    {
        self::addRoute('POST', $uri, $action);
    }

    public static function any(string $uri, callable|array $action)
    {
        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $method) {
            self::addRoute($method, $uri, $action);
        }
    }
}
