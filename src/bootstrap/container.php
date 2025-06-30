<?php

use App\Apps\Interface\LoggerInterface;
use App\Apps\Services\FileLogger;
use App\Core\Container\ServiceContainer;
use App\Core\Http\Request;

require_once __DIR__ . '../../../vendor/autoload.php';

$container = new ServiceContainer();

// Bindings
$container->singleton(LoggerInterface::class, FileLogger::class);
$container->singleton(Request::class, Request::class);

return $container;
