<?php

declare(strict_types=1);

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once(__DIR__ . '/../vendor/autoload.php');
require __DIR__ . '/../configs/paths_constants.php';
require __DIR__ . '/../configs/templating.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = require __DIR__ . '/../configs/container/container.php';

//--------------------------------------------------
$routes = require __DIR__ . '/../configs/routes/web.php';

// Set container to create App with slim bridge to DI container
$app = \DI\Bridge\Slim\Bridge::create($container);

// get routes
$routes($app);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

$app->run();
