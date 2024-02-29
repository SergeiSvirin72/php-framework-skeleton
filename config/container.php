<?php

use Framework\Container\Container;

return [
    'pdo_dsn' => 'pgsql:host=172.1.0.1;port=5432;dbname=postgres;',
    'pdo_user' => 'user',
    'pdo_password' => 'password',
    'pdo_options' => [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ],

    \PDO::class => function (Container $c) {
        return new \PDO(
            $c->get('pdo_dsn'),
            $c->get('pdo_user'),
            $c->get('pdo_password'),
            $c->get('pdo_options'),
        );
    },

    \Framework\Router\Router::class => function () {
        return new Framework\Router\Router();
    },
    \Framework\Renderer\Renderer::class => function () {
        return new Framework\Renderer\Renderer();
    },
    \Framework\Handler\NotFoundHandler::class => function () {
        return new \Framework\Handler\NotFoundHandler();
    },
    \Framework\Handler\InternalErrorHandler::class => function () {
        return new \Framework\Handler\InternalErrorHandler();
    },

    \App\Middleware\TestMiddleware::class => function () {
        return new \App\Middleware\TestMiddleware();
    },
    \App\Handler\TestHandler::class => function (Container $c) {
        return new \App\Handler\TestHandler($c->get(\Framework\Renderer\Renderer::class));
    }
];
