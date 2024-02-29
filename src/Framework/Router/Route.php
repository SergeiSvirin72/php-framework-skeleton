<?php

declare(strict_types=1);

namespace Framework\Router;

class Route
{
    public function __construct(
        public readonly array $methods,
        public readonly string $path,
        public readonly string $handler,
        public readonly array $middlewares = []
    ) {
    }
}
