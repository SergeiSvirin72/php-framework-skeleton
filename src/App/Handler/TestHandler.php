<?php

declare(strict_types=1);

namespace App\Handler;

use Framework\Handler\HandlerInterface;
use Framework\Message\Request;
use Framework\Message\Response;
use Framework\Renderer\Renderer;

class TestHandler implements HandlerInterface
{
    public function __construct(private Renderer $renderer)
    {
    }

    public function handle(Request $request): Response
    {
        $data = ['message' => 'From handler'];

        return new Response($this->renderer->render('test', $data), 200, ['Content-type' => ['text/html']]);
    }
}
