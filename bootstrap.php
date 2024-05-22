<?php

declare(strict_types=1);

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once(__DIR__ . '/vendor/autoload.php');
require __DIR__ . '/configs/paths_constants.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = require CONFIG_PATH . '/container/container.php';

// Set container to create App with slim bridge to DI container
$app = \DI\Bridge\Slim\Bridge::create($container);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

return $app;