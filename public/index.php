<?php

declare(strict_types=1);

use Framework\Application;
use Framework\Container\Container;
use Framework\Message\ResponseEmitter;
use Framework\Message\RequestFactory;

require '../vendor/autoload.php';

$container = new Container(require '../config/container.php');
$app = new Application($container);

require '../config/routes.php';

$request = RequestFactory::fromGlobals();
$response = $app->run($request);
ResponseEmitter::emit($response);
