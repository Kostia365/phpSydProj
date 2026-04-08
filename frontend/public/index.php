<?php


declare(strict_types=1);

use App\Controllers\UserController;
use Doctrine\ORM\EntityManager;
use Knilo\PhpSydProj\Service\UserService;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var EntityManager $entityManager */
$entityManager = require_once __DIR__ . '/../config/database.php';

// 3. Инициализируем зависимости (Manual Dependency Injection)
$userService = new UserService($entityManager);
$userController = new UserController($userService);

// 4. Получаем данные запроса
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// 5. Простейший Роутинг
// Мы проверяем, куда пришел пользователь и каким методом
if ($uri === '/register' && $method === 'POST') {

    // Вызываем метод контроллера
    $userController->create();

} elseif ($uri === '/users' && $method === 'GET') {

    // Пример другого эндпоинта (если захочешь список пользователей)
    echo json_encode(['message' => 'Список пользователей пока пуст']);

} else {

    // Если маршрут не найден
    header("HTTP/1.1 404 Not Found");
    echo json_encode([
        'error' => 'Endpoint not found',
        'requested_uri' => $uri,
        'method' => $method
    ]);
}