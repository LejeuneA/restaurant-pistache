<?php

declare(strict_types=1);

$localConfigPath = __DIR__ . '/conf-db.local.php';
$productionConfigPath = '/home/acelyalejeune/private/restaurant-pistache-db.php';

if (is_file($localConfigPath)) {
    $databaseConfig = require $localConfigPath;
} elseif (is_file($productionConfigPath)) {
    $databaseConfig = require $productionConfigPath;
} else {
    throw new RuntimeException('Database configuration file not found.');
}

if (!is_array($databaseConfig)) {
    throw new RuntimeException('Database configuration must return an array.');
}

$requiredKeys = [
    'host',
    'user',
    'password',
    'database',
];

foreach ($requiredKeys as $requiredKey) {
    if (!array_key_exists($requiredKey, $databaseConfig)) {
        throw new RuntimeException(
            'Missing database configuration key: ' . $requiredKey
        );
    }
}

define('SERVER_NAME', (string) $databaseConfig['host']);
define('USER_NAME', (string) $databaseConfig['user']);
define('USER_PWD', (string) $databaseConfig['password']);
define('DB_NAME', (string) $databaseConfig['database']);
