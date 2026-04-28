<?php

namespace Knilo\PhpSydProj\DTO;
readonly class ServiceDTO
{
    public function __construct(
        public string $name,
        public float  $price,
        public int    $duration_minutes
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: htmlspecialchars($data['name'] ?? ''),
            price: (float)($data['price'] ?? 0),
            duration_minutes: (int)($data['duration_minutes'] ?? 30)
        );
    }
}