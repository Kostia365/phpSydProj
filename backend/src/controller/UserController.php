<?php

namespace App\Controllers;

use CreateUserDto;
use Exception;
use UserService;

class UserController
{
    public function __construct(private UserService $userService)
    {
    }

    public function create(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);

        try {
            if (empty($input['email']) || empty($input['password'])) {
                throw new Exception("Email and password are required");
            }

            $dto = new CreateUserDto(
                name: $input['name'] ?? 'Anonymous',
                email: $input['email'],
                password: $input['password'],
                role: $input['role'] ?? null
            );

            $user = $this->userService->createUser($dto);

            header('Content-Type: application/json');
            echo json_encode([
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'status' => 'created'
            ]);

        } catch (Exception $e) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}