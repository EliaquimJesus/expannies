<?php

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\DependencyFactory;
use Symfony\Component\Console\Application;
use Doctrine\Migrations\Tools\Console\ConsoleRunner;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
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

$commands = [
    new CurrentCommand($dependencyFactory),
    new DumpSchemaCommand($dependencyFactory),
    new ExecuteCommand($dependencyFactory),
    new GenerateCommand($dependencyFactory),
    new LatestCommand($dependencyFactory),
    new MigrateCommand($dependencyFactory),
    new RollupCommand($dependencyFactory),
    new StatusCommand($dependencyFactory),
    new VersionCommand($dependencyFactory),
    new UpToDateCommand($dependencyFactory),
    new SyncMetadataCommand($dependencyFactory),
    new ListCommand($dependencyFactory),
    new DiffCommand($dependencyFactory)
];

$migrationCommands = require CONFIG_PATH . '/commands/migration_commands.php';
$customCommands    = require CONFIG_PATH . '/commands/commands.php';

// ConsoleRunner::run(
//     new SingleManagerProvider($entityManager),
//     $commands
// );

$cliApp = new Application('App kuk', '1.0');

ConsoleConsoleRunner::addCommands($cliApp, new SingleManagerProvider($entityManager));

$cliApp->addCommands($migrationCommands($dependencyFactory));

$cliApp->run();

// php runcli.php migrations:migrate
