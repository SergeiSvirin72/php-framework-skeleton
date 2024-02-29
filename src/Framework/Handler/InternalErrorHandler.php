<?php

declare(strict_types=1);

namespace Framework\Handler;

use Framework\Message\Request;
use Framework\Message\Response;

class InternalErrorHandler implements HandlerInterface
{
    public function handle(Request $request): Response
    {
        if (isset($request->headers['Content-Type']) && $request->headers['Content-Type'] === 'application/json') {
            $headers = ['Content-type' => ['application/json']];
        } else {
            $headers = ['Content-type' => ['text/html']];
        }

        return new Response('InternalError', 500, $headers);
    }
}
