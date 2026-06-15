<?php

namespace Knilo\PhpSydProj\Controllers;

use Knilo\PhpSydProj\Enums\BookingStatus;
use Knilo\PhpSydProj\Services\BarberService;
use Knilo\PhpSydProj\Services\BookingService;

class BookingController
{
    private BookingService $bookingService;
    private BarberService $barberService;
    private string $templatePath = __DIR__ . '/../../../frontend/templates/';

    public function __construct(BookingService $bookingService, BarberService $barberService)
    {
        $this->bookingService = $bookingService;
        $this->barberService = $barberService;
    }

    public function showBookingForm(): void
    {
        $this->requireLogin();

        $title = 'Book Appointment';
        $services = $this->barberService->getAllServices();
        $content = $this->templatePath . 'booking/form.php';

        include $this->templatePath . 'layout.php';
    }

    public function checkout(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appointmentTime = $_POST['appointment_time'] ?? '';

            if (empty($appointmentTime) || strtotime($appointmentTime) <= time()) {
                $error = 'Appointment time must be in the future.';
                $title = 'Book Appointment';
                $services = $this->barberService->getAllServices();
                $content = $this->templatePath . 'booking/form.php';
                include $this->templatePath . 'layout.php';
                return;
            }

            $data = [
                'user_id' => (int)$_SESSION['user_id'],
                'service_id' => (int)$_POST['service_id'],
                'time' => $appointmentTime,
                'status' => BookingStatus::Pending->value,
            ];

            $this->bookingService->createBooking($data);

            header('Location: /?route=my-bookings');
            exit;
        }

        header('Location: /?route=booking');
        exit;
    }

    public function myBookings(): void
    {
        $this->requireLogin();

        $title = 'My Bookings';
        $bookings = $this->bookingService->getBookingsByUser((int)$_SESSION['user_id']);
        $content = $this->templatePath . 'booking/my_list.php';

        include $this->templatePath . 'layout.php';
    }

    public function allBookings(): void
    {
        $this->requireAdmin();

        $title = 'All Bookings';
        $bookings = $this->bookingService->getAllBookings();
        $content = $this->templatePath . 'booking/admin_list.php';

        include $this->templatePath . 'layout.php';
    }

    public function updateStatus(): void
    {
        $this->requireAdmin();

        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';

        $allowed = ['pending', 'confirmed', 'cancelled', 'completed'];
        if ($id > 0 && in_array($status, $allowed, true)) {
            $this->bookingService->updateStatus($id, $status);
        }

        header('Location: /?route=booking-all');
        exit;
    }

    private function requireLogin(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /?route=login');
            exit;
        }
    }

    private function requireAdmin(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (($_SESSION['user_role'] ?? null) !== 'admin') {
            header('Location: /?route=login');
            exit;
        }
    }
}