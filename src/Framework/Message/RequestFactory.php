<?php

declare(strict_types=1);

namespace Framework\Message;

use Exception;

class RequestFactory
{
    public static function fromGlobals(): Request
    {
        $uri = sprintf(
            '%s://%s%s',
            (isset($_SERVER['HTTPS']) ? "https" : "http"),
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI'],
        );

        $headers = getallheaders();
        if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
            $body = stream_get_contents(fopen('php://input', 'r+b'));
            $parsedBody = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            if (!is_array($parsedBody)) {
                throw new Exception('Can\'t decode JSON');
            }
        } else {
            $parsedBody = $_POST;
        }

        return new Request(
            new Uri($uri),
            $_SERVER['REQUEST_METHOD'],
            $_GET,
            $parsedBody,
            $headers
        );
    }
}
