<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

// ---------------- Entity Manager -------------------------
// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/../Entity"),
    isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection((new \App\Config($_ENV))->db, $config);
