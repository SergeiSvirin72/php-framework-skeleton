<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Message\Request;
use Framework\Message\Response;
use Framework\Middleware\MiddlewareInterface;

class TestMiddleware implements MiddlewareInterface
{
    public function process(Request $request): ?Response
    {
        if (isset($request->queryParams['return_in_middleware'])) {
            return new Response("From middleware", 200, ['Content-type' => ['text/plain']]);
        }

        return null;
    }
}
