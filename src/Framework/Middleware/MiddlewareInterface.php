<?php

declare(strict_types=1);

namespace Framework\Middleware;

use Framework\Message\Request;
use Framework\Message\Response;

interface MiddlewareInterface
{
    public function process(Request $request): ?Response;
}
