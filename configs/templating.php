<?php

declare(strict_types=1);

use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;

$twig = Twig::create(VIEW_PATH, [
    'cache' => STORAGE_PATH . '/cache',
]);
    
// formater currency
$twig->addExtension(new IntlExtension());
    
    
