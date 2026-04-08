<?php

namespace Knilo\PhpSydProj\Entities;

use Doctrine\ORM\Mapping as ORM;

use Enums\UserStatus;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $name;
    #[ORM\Column(type: 'string', enumType: UserStatus::class)]
    private UserStatus $role = UserStatus::USER;
    #[ORM\Column(type: 'string', length: 255)]
    private string $password;
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $email;
    public function __construct(
        string     $name,
        string     $email,
        string     $password,
        UserStatus $role = UserStatus::USER
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}