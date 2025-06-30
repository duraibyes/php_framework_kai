<?php

use App\Core\Routes\Po;

error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display them on screen
ini_set('display_startup_errors', 1); // Also show startup errors

require_once __DIR__ . '/vendor/autoload.php';

$routes = require_once  __DIR__ . "/routes/web.php";

$container = require_once __DIR__ . "/src/bootstrap/container.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

$routes = Po::getRoutes();

if (isset($routes[$method][$uri])) {
    [$controllerClass, $methodName] = $routes[$method][$uri];
    $controller = $container->make($controllerClass);

    $reflection = new ReflectionMethod($controller, $methodName);
    $params = [];

    foreach ($reflection->getParameters() as $param) {
        $type = $param->getType();
        if ($type && !$type->isBuiltin()) {
            $params[] = $container->make($type->getName());
        } else {
            throw new Exception("Cannot resolve parameter \${$param->getName()}");
        }
    }

    call_user_func_array([$controller, $methodName], $params);
} else {
    http_response_code(404);
    echo "❌ 404 Not Found: $uri";
}
