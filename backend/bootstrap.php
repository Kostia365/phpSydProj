<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $dsn = sprintf(
        "pgsql:host=%s;port=%d;dbname=%s",
        $_ENV['DB_HOST'],
        $_ENV['DB_PORT'],
        $_ENV['DB_NAME']
    );

    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Ошибки в виде исключений
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Данные в виде массивов
        PDO::ATTR_EMULATE_PREPARES => false,                  // Реальная защита от SQL-инъекций
    ]);

    return $pdo;

} catch (\PDOException $e) {
    header('Content-Type: text/plain');
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}