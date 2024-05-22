<?php

declare(strict_types=1);

//--------------------------------------------------
$app    = require __DIR__ . '/../bootstrap.php';
$routes = require CONFIG_PATH . '/routes/web.php';

// get routes
$routes($app);

$app->run();
