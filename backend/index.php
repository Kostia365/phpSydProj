<?php

require_once __DIR__ . '/bootstrap.php';
$entityManager = require_once __DIR__ . '/bootstrap.php';
use Knilo\PhpSydProj\Entities\User;
use Enums\UserStatus;

// 1. Создаем объект
$user = new User(
    name: "Gemini User",
    email: "test@example.com",
    password: password_hash("secret123", PASSWORD_BCRYPT),
    role: UserStatus::USER
);

$entityManager->persist($user);
$entityManager->flush();

echo "Ура! Пользователь сохранен с ID: " . $user->getId();