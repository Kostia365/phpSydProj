<?php

namespace Knilo\PhpSydProj\DTO;

readonly class UserRegistrationDTO
{
    public function __construct(
        public string $email,
        public string $password,
        public string $confirmPassword
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            email: filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL),
            password: $data['password'] ?? '',
            confirmPassword: $data['confirm_password'] ?? ''
        );
    }
}