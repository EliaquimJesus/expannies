<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// replace with path to your own project bootstrap file
require_once __DIR__ . '/bootstrap.php';

$configg = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$entityManager = $entityManager = new EntityManager($connection, $config);

// --------------------------------------------------

return DependencyFactory::fromEntityManager($configg, new ExistingEntityManager($entityManager));