<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Services\EntityManage;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$configg = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$entityManager = (new EntityManage())->getEntity();

// --------------------------------------------------

return DependencyFactory::fromEntityManager($configg, new ExistingEntityManager($entityManager));