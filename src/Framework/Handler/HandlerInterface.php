<?php

declare(strict_types=1);

namespace Framework\Handler;

use Framework\Message\Request;
use Framework\Message\Response;

interface HandlerInterface
{
    public function handle(Request $request): Response;
}
