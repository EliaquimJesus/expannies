<?php

declare(strict_types=1);

use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;

return [

        Twig::class    => function () {
            $twig = Twig::create(VIEW_PATH, [
                'cache' => STORAGE_PATH . '/cache/templates',
                'auto_reload' => \App\Enums\AppEnvironment::isDevelopment('production'),
            ]);

            $twig->addExtension(new IntlExtension());
        // $twig->addExtension(new EntryFilesTwigExtension($container));
            //$twig->addExtension(new AssetExtension($container->get('webpack_encore.packages')));

            return $twig;
       },
];