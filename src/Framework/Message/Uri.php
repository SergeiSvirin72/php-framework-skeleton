<?php

declare(strict_types=1);

namespace Framework\Message;

class Uri
{
    private array $parts;

    public function __construct(string $uri)
    {
        $this->parts = parse_url($uri);
    }

    public function getPath(): string
    {
        return $this->parts['path'];
    }
}
