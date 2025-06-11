<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.testing');
$dotenv->load();

$appEnv = $_ENV['APP_ENV'] ?? 'production';
$dbConnection = $_ENV['DB_CONNECTION'] ?? 'mysql';
$dbName = $_ENV['DB_DATABASE'] ?? '';

if ($appEnv !== 'testing') {
    fwrite(STDERR, "❌ Aborting: Tests must run in 'testing' environment, not '$appEnv'!\n");
    exit(1);
}

$forbiddenConnections = ['mysql', 'pgsql', 'sqlsrv'];
$forbiddenDbNames = ['production', 'prod', 'live'];

if (in_array($dbConnection, $forbiddenConnections) && in_array($dbName, $forbiddenDbNames)) {
    fwrite(STDERR, "❌ Aborting: Tests are configured to run on a production-like database!\n");
    exit(1);
}
