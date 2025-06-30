<?php

namespace App\Core\Container;

use ReflectionClass;
use Exception;

class ServiceContainer
{
    protected array $bindings = [];
    protected array $singletons = [];

    public function bind(string $abstract, string|\Closure $concrete, bool $singleton = false)
    {
        $this->bindings[$abstract] = compact('concrete', 'singleton');
    }

    public function singleton(string $abstract, string|\Closure $concrete)
    {
        $this->bind($abstract, $concrete, true);
    }

    public function make(string $abstract)
    {

        if (isset($this->singletons[$abstract])) {
            return $this->singletons[$abstract];
        }

        if (!isset($this->bindings[$abstract])) {
            return $this->build($abstract);
        }

        $binding = $this->bindings[$abstract];
        $concrete = $binding['concrete'];

        $object = $concrete instanceof \Closure
            ? $concrete($this)
            : $this->build($concrete);

        if ($binding['singleton']) {
            $this->singletons[$abstract] = $object;
        }

        return $object;
    }

    public function build(string $concrete)
    {

        if (!class_exists($concrete)) {
            throw new Exception("Class [$concrete] does not exist.");
        }

        $reflection = new ReflectionClass($concrete);

        if (!$reflection->isInstantiable()) {
            throw new Exception("Class [$concrete] is not instantiable.");
        }

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $concrete;
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();

            if ($type === null || $type->isBuiltin()) {
                throw new Exception("Cannot resolve parameter \${$param->getName()} in [$concrete]");
            }

            $dependencies[] = $this->make($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }

    // Just for debugging output
    public function debug()
    {
        show($this->bindings);

        show($this->singletons);
    }
}
