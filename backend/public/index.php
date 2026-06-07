<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/dto/CreateUserDto.php';

use Knilo\PhpSydProj\Infrastructure\Database;
use Knilo\PhpSydProj\Controllers\UserController;
use Knilo\PhpSydProj\Services\UserService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$pdo = Database::getConnection();
$userService = new UserService($pdo);
$userController = new UserController($userService);
$action = $_GET['route'] ?? 'home';
$title = "Project";
$styles = ['/css/style.css'];
$content = "";

switch ($action) {
    case 'home':
        $title = "Home Page";
        $content = __DIR__ . '/../../frontend/templates/home.php';
        break;

    case 'register':
        $title = "Registration";
        $content = __DIR__ . '/../../frontend/templates/register.php'; // Сначала задаем шаблон

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Проверяем наличие ключей, чтобы не было TypeError
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$name || !$email || !$password) {
                header('Location: /?route=register&error=empty');
                exit;
            }

            $dto = new CreateUserDto(
                name: $name,
                email: $email,
                password: password_hash($password, PASSWORD_BCRYPT),
                role: 'customer'
            );

            try {
                $sql = "INSERT INTO users (name, email, password, role) 
                        VALUES (:name, :email, :password, :role) 
                        RETURNING id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $dto->name,
                    'email' => $dto->email,
                    'password' => $dto->password,
                    'role' => $dto->role ?? 'customer'
                ]);

                $userId = $stmt->fetchColumn();

                if (!session_id()) session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_name'] = $dto->name;
                $_SESSION['user_email'] = $dto->email;

                header('Location: /?route=dashboard');
                exit;

            } catch (PDOException $e) {
                header('Location: /?route=register&error=exists');
                exit;
            }
        }
        break;

    case 'dashboard': // Добавляем этот кейс, иначе после редиректа будет 404
        $title = "Dashboard";
        $content = __DIR__ . '/../../frontend/templates/dashboard.php';
        break;

    case 'login':
        $title = "Login";
        $content = __DIR__ . '/../../frontend/templates/login.php';
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit;
}
include __DIR__ . '/../../frontend/templates/layout.php';