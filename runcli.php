<?php

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\DependencyFactory;
use Symfony\Component\Console\Application;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\ORM\Tools\Console\ConsoleRunner as ConsoleConsoleRunner;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// replace with path to your own project bootstrap file
require_once __DIR__ . '/bootstrap.php';
require_once CONFIG_PATH . '/doctrineEM.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = new EntityManager($connection, $config);

$configg = new PhpFile(CONFIG_PATH . '/migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders
$dependencyFactory = DependencyFactory::fromEntityManager($configg, new ExistingEntityManager($entityManager));

$migrationCommands = require CONFIG_PATH . '/commands/migration_commands.php';
$customCommands    = require CONFIG_PATH . '/commands/commands.php';

// ConsoleRunner::run(
//     new SingleManagerProvider($entityManager),
//     $commands
// );

$cliApp = new Application('expannies', '1.0');

ConsoleConsoleRunner::addCommands($cliApp, new SingleManagerProvider($entityManager));

$cliApp->addCommands($migrationCommands($dependencyFactory));

$cliApp->run();

// php runcli.php migrations:migrate
