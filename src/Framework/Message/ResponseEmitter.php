<?php

declare(strict_types=1);

namespace Framework\Message;

class ResponseEmitter
{
    public static function emit(Response $response): void
    {
        http_response_code($response->getStatusCode());

        foreach ($response->getHeaders() as $header => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $header, $value));
            }
        }

        echo $response->getBody();
    }
}
