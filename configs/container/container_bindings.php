<?php

declare(strict_types=1);

use App\Config;
use App\Enum\AppEnvironment;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;
use Twig\Extra\Intl\IntlExtension;

use function DI\create;

//Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/../Entity"),
    isDevMode: true,
);

return [
        EntityManager::class => function($config){
            $entityManager = new EntityManager(DriverManager::getConnection((new \App\Config($_ENV))->db, $config), $config);
            
            return $entityManager;
        },
        
        Twig::class    => function () {
            $twig = Twig::create(VIEW_PATH, [
                'cache'       => STORAGE_PATH . '/cache/templates',
            ]);

            $twig->addExtension(new IntlExtension());
        // $twig->addExtension(new EntryFilesTwigExtension($container));
            //$twig->addExtension(new AssetExtension($container->get('webpack_encore.packages')));

            return $twig;
       },
    /**
     * The following two bindings are needed for EntryFilesTwigExtension & AssetExtension to work for Twig
     */
    // 'webpack_encore.packages'     => fn() => new Packages(
    //     new Package(new JsonManifestVersionStrategy(BUILD_PATH . '/manifest.json'))
    // ),
    // 'webpack_encore.tag_renderer' => fn(ContainerInterface $container) => new TagRenderer(
    //     new EntrypointLookup(BUILD_PATH . '/entrypoints.json'),
    //     $container->get('webpack_encore.packages')
    // ),
];