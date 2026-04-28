<?php

namespace Knilo\PhpSydProj\Controllers;

use Enums\BookingStatus;
use Knilo\PhpSydProj\Service\BookingService;

class BookingController {
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function showBookingForm(): void {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        include __DIR__ . '/../../../frontend/templates/booking/form.php';
    }

    public function checkout(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'service_id' => (int)$_POST['service_id'],
                'time' => $_POST['appointment_time'],
                'status' => BookingStatus::Pending->value
            ];

            $this->bookingService->createBooking($data);
            header('Location: /my-bookings');
            exit;
        }
    }
    public function myBookings(): void {
        $userId = $_SESSION['user_id'];
        $bookings = $this->bookingService->getBookingsByUser($userId);
        include __DIR__ . '/../../../frontend/templates/booking/my_list.php';
    }
}