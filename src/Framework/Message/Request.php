<?php

declare(strict_types=1);

namespace Framework\Message;

class Request
{
    private array $attributes = [];

    public function __construct(
        public readonly Uri $uri,
        public readonly string $method,
        public readonly array $queryParams,
        public readonly array $parsedBody,
        public readonly array $headers,
    ) {
    }

    public function getAttribute(string $name): mixed
    {
        return $this->attributes[$name] ?? null;
    }

    public function withAttribute(string $name, mixed $value): void
    {
        $this->attributes[$name] = $value;
    }
}
