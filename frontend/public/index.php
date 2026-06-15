<?php

require_once __DIR__ . '/../../backend/vendor/autoload.php';

use Dotenv\Dotenv;
use Knilo\PhpSydProj\Controllers\BookingController;
use Knilo\PhpSydProj\Controllers\ServiceController;
use Knilo\PhpSydProj\Controllers\UserController;
use Knilo\PhpSydProj\Services\BarberService;
use Knilo\PhpSydProj\Services\BookingService;
use Knilo\PhpSydProj\Services\UserService;

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax',
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../backend/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../backend');
$dotenv->load();

$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s',
    $_ENV['DB_HOST'],
    $_ENV['DB_PORT'],
    $_ENV['DB_NAME']
);

$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$userService = new UserService($pdo);
$barberService = new BarberService($pdo);
$bookingService = new BookingService($pdo);

$userController = new UserController($userService);
$serviceController = new ServiceController($barberService);
$bookingController = new BookingController($bookingService, $barberService);

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'home':
        $title = 'Welcome';
        $content = __DIR__ . '/../templates/Home.php';
        include __DIR__ . '/../templates/layout.php';
        break;

    case 'register':
        $userController->register();
        break;

    case 'login':
        $userController->login();
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'dashboard':
        $title = 'Dashboard';
        $content = __DIR__ . '/../templates/dashboard.php';
        include __DIR__ . '/../templates/layout.php';
        break;

    case 'services':
        $serviceController->index();
        break;

    case 'service-create':
        $serviceController->create();
        break;

    case 'service-edit':
        $serviceController->edit((int)($_GET['id'] ?? 0));
        break;

    case 'service-delete':
        $serviceController->delete((int)($_GET['id'] ?? 0));
        break;

    case 'booking':
        $bookingController->showBookingForm();
        break;

    case 'booking-checkout':
        $bookingController->checkout();
        break;

    case 'my-bookings':
        $bookingController->myBookings();
        break;

    case 'booking-all':
        $bookingController->allBookings();
        break;

    case 'booking-status':
        $bookingController->updateStatus();
        break;

    default:
        http_response_code(404);
        $title = '404 Not Found';
        $content = __DIR__ . '/../templates/404.php';
        include __DIR__ . '/../templates/layout.php';
        break;
}