<?php

namespace Knilo\PhpSydProj\Controllers;

use CreateUserDto;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Knilo\PhpSydProj\DTO\UserRegistrationDTO;
use Knilo\PhpSydProj\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            include __DIR__ . '/../../../frontend/templates/register.php';
            return;
        }

        try {
            $dto = UserRegistrationDTO::fromArray($_POST);
            if ($dto->password !== $dto->confirmPassword) {
                throw new \Exception("passwords don't match!");
            }

            $this->userService->registerNewUser($dto);

            header('Location: /login?success=registered');
            exit;

        } catch (\Exception $e) {
            $error = $e->getMessage();
            include __DIR__ . '/../../../frontend/templates/register.php';
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = $this->userService->authenticate($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_role'] = $user->role;

                header('Location: /dashboard');
                exit;
            } else {
                $error = "wrong email or password";
            }
        }
        include __DIR__ . '/../../../frontend/templates/login.php';
    }

    #[NoReturn]
    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}