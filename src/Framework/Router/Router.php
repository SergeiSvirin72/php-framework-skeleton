<?php

declare(strict_types=1);

namespace Framework\Router;

use Exception;
use Framework\Message\Request;

class Router
{
    /**
     * @var Route[]
     */
    private array $routes;

    public function add(array $methods, string $path, string $handler, array $middlewares): void
    {
        $this->routes[] = new Route($methods, $path, $handler, $middlewares);
    }

    public function match(Request $request): Route
    {
        foreach ($this->routes as $route) {
            if (
                in_array($request->method, $route->methods, true)
                && strtolower($request->uri->getPath()) === $route->path
            ) {
                return $route;
            }
        }

        throw new Exception("Route not found");
    }
}
