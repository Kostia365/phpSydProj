<?php

/**
 * Run this script once after applying V1__init.sql to hash the admin password.
 * Usage: php backend/setup_admin.php
 */

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s',
    $_ENV['DB_HOST'],
    $_ENV['DB_PORT'],
    $_ENV['DB_NAME']
);

$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$adminPassword = '123qwe';
$hashed = password_hash($adminPassword, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@barber.com'");
$stmt->execute([$hashed]);

if ($stmt->rowCount() > 0) {
    echo "Admin password hashed successfully.\n";
    echo "Login: admin@barber.com / 123qwe\n";
} else {
    echo "Admin user not found. Make sure you applied V1__init.sql first.\n";
}
