namespace Knilo\PhpSydProj\Service;
namespace Knilo\PhpSydProj\Service;
namespace Knilo\PhpSydProj\Service;
namespace Knilo\PhpSydProj\Service;
namespace Knilo\PhpSydProj\Service;
import Doctrine\ORM\EntityManagerInterface;
<?php

use Knilo\PhpSydProj\Entities\User;
use Enums\UserStatus;

class UserService
{
    public function __construct(private EntiyManagerInterface $entiyManager)
    {
    }

    public function createUser(CreateUserDto $dto): User
    {
        $role = UserStatus::tryFrom($dto->role) ?? UserStatus::USER;
        $hashedPassword = password_hash($dto->password, PASSWORD_BCRYPT);

        $user = new User(
                name: $dto->name,
                email: $dto->email,
                password: $hashedPassword,
                role: $role
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

}