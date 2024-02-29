<?php

declare(strict_types=1);

namespace Framework\Message;

class Response
{
    public function __construct(
        private string $body,
        private int $code,
        private array $headers
    ) {
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function withHeader(string $name, array $value): void
    {
        $this->headers[$name] = $value;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function withBody(string $body): void
    {
        $this->body .= $body;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function withStatus(int $code): void
    {
        $this->code = $code;
    }
}
