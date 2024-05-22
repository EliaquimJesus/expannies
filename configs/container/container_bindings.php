<?php

declare(strict_types=1);

use App\Config;
use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;
use Symfony\Component\Asset\Package;
use Psr\Container\ContainerInterface;
use Symfony\Component\Asset\Packages;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

return [

        Twig::class    => function (Config $config, ContainerInterface $container) {
            $twig = Twig::create(VIEW_PATH, [
                'cache' => STORAGE_PATH . '/cache/templates',
                'auto_reload' => \App\Enums\AppEnvironment::isDevelopment('production'),
            ]);

            $twig->addExtension(new IntlExtension());
            $twig->addExtension(new EntryFilesTwigExtension($container));
            $twig->addExtension(new AssetExtension($container->get('webpack_encore.packages')));

            return $twig;
       },
       /**
     * The following two bindings are needed for EntryFilesTwigExtension & AssetExtension to work for Twig
     */
        'webpack_encore.packages'     => fn() => new Packages(
            new Package(new JsonManifestVersionStrategy(BUILD_PATH . '/manifest.json'))
        ),
        // 'webpack_encore.tag_renderer' => fn(ContainerInterface $container) => new TagRenderer(
        //     new EntrypointLookup(BUILD_PATH . '/entrypoints.json'),
        //     $container->get('webpack_encore.packages')
        // ),
];