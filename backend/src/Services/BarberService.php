<?php

namespace Knilo\PhpSydProj\Service;

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
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Service(
            id: $row['id'],
            name: $row['name'],
            price: (float)$row['price'],
            duration_minutes: $row['duration_minutes']
        ), $rows);
    }

    public function addService(ServiceDTO $dto): bool
    {
        $sql = "INSERT INTO services (name, price, duration_minutes) VALUES (:name, :price, :duration)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $dto->name,
            'price' => $dto->price,
            'duration' => $dto->duration_minutes
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
            'duration' => $dto->duration_minutes
        ]);
    }

    public function deleteService(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM services WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getServiceById(int $id): ?Service
    {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Service($row['id'], $row['name'], null, (float)$row['price'], $row['duration_minutes']) : null;
    }
}