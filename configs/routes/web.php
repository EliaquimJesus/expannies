<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoicesController;

return function(\Slim\App $app){
    $app->get('/', [HomeController::class, 'index']);
};
