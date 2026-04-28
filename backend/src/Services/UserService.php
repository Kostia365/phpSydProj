<?php

namespace Knilo\PhpSydProj\Services;

use Knilo\PhpSydProj\DTO\UserRegistrationDTO;

use PDO;

class UserService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function registerNewUser(UserRegistrationDTO $dto): bool
    {
        $hashedPassword = password_hash($dto->password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([
            $dto->email,
            $hashedPassword,
            'customer'
        ]);
    }

    public function authenticate(string $email, string $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetchObject();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}