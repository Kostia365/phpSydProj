<?php

namespace Knilo\PhpSydProj\Services;

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
            'status' => $data['status'],
        ]);
    }

    public function getBookingsByUser(int $userId): array
    {
        $sql = "SELECT b.*, s.name AS service_name, s.price, s.duration_minutes
                FROM bookings b
                JOIN services s ON b.service_id = s.id
                WHERE b.user_id = ?
                ORDER BY b.appointment_time DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookings(): array
    {
        $sql = "SELECT b.*, s.name AS service_name, u.name AS user_name, u.email AS user_email
                FROM bookings b
                JOIN services s ON b.service_id = s.id
                JOIN users u ON b.user_id = u.id
                ORDER BY b.appointment_time DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}