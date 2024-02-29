<?php

use Framework\Application;

/** @var Application $app */
$app->route(['GET'], '/test', \App\Handler\TestHandler::class, [\App\Middleware\TestMiddleware::class]);
