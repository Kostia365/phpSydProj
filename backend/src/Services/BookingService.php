<?php

namespace Knilo\PhpSydProj\Service;

use PDO;

class BookingService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createBooking(array $data): bool
    {
        $sql = "INSERT INTO bookings (user_id, service_id, appointment_time, status) 
                VALUES (:u_id, :s_id, :time, :status)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'u_id' => $data['user_id'],
            's_id' => $data['service_id'],
            'time' => $data['time'],
            'status' => $data['status'] // Берем строку из Enum
        ]);
    }

    public function getBookingsByUser(int $userId): array
    {
        $sql = "SELECT b.*, s.name as service_name 
                FROM bookings b 
                JOIN services s ON b.service_id = s.id 
                WHERE b.user_id = ? 
                ORDER BY b.appointment_time DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}