<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Knilo\PhpSydProj\Infrastructure\Database;
use Knilo\PhpSydProj\Controllers\UserController;
use Knilo\PhpSydProj\Services\UserService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$pdo = Database::getConnection();
$userService = new UserService($pdo);
$userController = new UserController($userService);

$action = $_GET['action'] ?? 'home';

if ($action === 'register') {
    $userController->register();
} else {
    echo "ur on the main page ?action=register";
}