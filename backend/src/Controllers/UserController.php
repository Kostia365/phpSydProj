<?php

namespace Knilo\PhpSydProj\Controllers;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Knilo\PhpSydProj\DTO\UserRegistrationDTO;
use Knilo\PhpSydProj\Services\UserService;

class UserController
{
    private UserService $userService;
    private string $templatePath = __DIR__ . '/../../../frontend/templates/';

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(): void
    {
        $title = "Register";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $dto = UserRegistrationDTO::fromArray($_POST);
                if ($dto->password !== $dto->confirmPassword) {
                    throw new Exception("Passwords do not match!");
                }

                $this->userService->registerNewUser($dto);

                header('Location: /?route=login&success=registered');
                exit;

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        $content = $this->templatePath . 'register.php';
        include $this->templatePath . 'layout.php';
    }

    public function login(): void
    {
        $title = "Login";
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = $this->userService->authenticate($email, $password);

            if ($user) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_role'] = $user->role;

                header('Location: /?route=dashboard');
                exit;
            } else {
                $error = "Invalid email or password";
            }
        }

        $content = $this->templatePath . 'login.php';
        include $this->templatePath . 'layout.php';
    }

    #[NoReturn]
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header('Location: /?route=home');
        exit;
    }
}