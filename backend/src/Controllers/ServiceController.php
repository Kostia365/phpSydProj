<?php

namespace Knilo\PhpSydProj\Controllers;

use JetBrains\PhpStorm\NoReturn;
use Knilo\PhpSydProj\DTO\ServiceDTO;
use Knilo\PhpSydProj\Services\BarberService;

class ServiceController
{
    private BarberService $serviceManager;
    private string $templatePath = __DIR__ . '/../../../frontend/templates/';

    public function __construct(BarberService $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function index(): void
    {
        $title = 'Services';
        $services = $this->serviceManager->getAllServices();
        $content = $this->templatePath . 'services/list.php';

        include $this->templatePath . 'layout.php';
    }

    public function create(): void
    {
        $this->requireAdmin();

        $title = 'Add Service';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dto = ServiceDTO::fromArray($_POST);
            $this->serviceManager->addService($dto);

            header('Location: /?route=services');
            exit;
        }

        $content = $this->templatePath . 'services/create.php';
        include $this->templatePath . 'layout.php';
    }

    public function edit(int $id): void
    {
        $this->requireAdmin();

        $title = 'Edit Service';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dto = ServiceDTO::fromArray($_POST);
            $this->serviceManager->updateService($id, $dto);

            header('Location: /?route=services');
            exit;
        }

        $service = $this->serviceManager->getServiceById($id);

        if (!$service) {
            http_response_code(404);
            echo 'Service not found';
            return;
        }

        $content = $this->templatePath . 'services/edit.php';
        include $this->templatePath . 'layout.php';
    }

    #[NoReturn]
    public function delete(int $id): void
    {
        $this->requireAdmin();

        $this->serviceManager->deleteService($id);

        header('Location: /?route=services');
        exit;
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