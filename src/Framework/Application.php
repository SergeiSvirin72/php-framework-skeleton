<?php

declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Container\Container;
use Framework\Handler\HandlerInterface;
use Framework\Handler\InternalErrorHandler;
use Framework\Handler\NotFoundHandler;
use Framework\Message\Request;
use Framework\Message\Response;
use Framework\Middleware\MiddlewareInterface;
use Framework\Router\Router;

class Application
{
    private Router $router;

    public function __construct(private Container $container)
    {
        $this->router = $this->container->get(Router::class);
    }

    public function route(array $methods, string $path, string $handler, array $middlewares): void
    {
        $this->router->add($methods, $path, $handler, $middlewares);
    }

    public function run(Request $request): Response
    {
        try {
            $route = $this->router->match($request);
        } catch (Exception) {
            return $this->handle($request, NotFoundHandler::class);
        }

//        Опциональный отлов ошибок, если включен дебаг - выводить стак трейс
//        try {
        foreach ($route->middlewares as $middleware) {
            $response = $this->process($request, $middleware);
            if (null !== $response) {
                return $response;
            }
        }

        return $this->handle($request, $route->handler);
//        } catch (Exception) {
//            return $this->handle($request, InternalErrorHandler::class);
//        }
    }

    private function handle(Request $request, string $className): Response
    {
        /** @var HandlerInterface $handler */
        $handler = $this->container->get($className);

        return $handler->handle($request);
    }

    private function process(Request $request, string $className): ?Response
    {
        /** @var MiddlewareInterface $middleware */
        $middleware = $this->container->get($className);

        return $middleware->process($request);
    }
}
