<?php
require_once __DIR__ . '/../../backend/vendor/autoload.php';

$entityManager = require_once __DIR__ . '/../../backend/config/Database.php';
$userService = new UserService($entityManager);
$userController = new UserController($userService);

$route = $_GET['route'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    switch ($route) {
        case 'register':
            $userController->register();
            exit;
        case 'login':
            $userController->login();
            exit;
    }
}

$title = "Project";
$content = "";

switch ($route) {
    case 'home':
        $title = "Welcome";
        $content = __DIR__ . '/../templates/home.php';
        break;
    case 'register':
        $title = "Create Account";
        $content = __DIR__ . '/../templates/register.php';
        break;
    case 'login':
        $title = "Login";
        $content = __DIR__ . '/../templates/login.php';
        break;
    case 'services':
        $title = "Services";
        $content = __DIR__ . '/../templates/services/list.php';
        break;
    default:
        $title = "404 Not Found";
        $content = __DIR__ . '/../templates/404.php';
}

include __DIR__ . '/../templates/layout.php';