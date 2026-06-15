<?php

namespace Knilo\PhpSydProj\Services;

use Knilo\PhpSydProj\DTO\ServiceDTO;
use PDO;

class BarberService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllServices(): array
    {
        $stmt = $this->db->query("SELECT * FROM services ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addService(ServiceDTO $dto): bool
    {
        $sql = "INSERT INTO services (name, price, duration_minutes) VALUES (:name, :price, :duration)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name' => $dto->name,
            'price' => $dto->price,
            'duration' => $dto->duration_minutes,
        ]);
    }

    public function updateService(int $id, ServiceDTO $dto): bool
    {
        $sql = "UPDATE services SET name = :name, price = :price, duration_minutes = :duration WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'name' => $dto->name,
            'price' => $dto->price,
            'duration' => $dto->duration_minutes,
        ]);
    }

    public function deleteService(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM services WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getServiceById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);

        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        return $service ?: null;
    }
}