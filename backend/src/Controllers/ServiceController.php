<?php

namespace Knilo\PhpSydProj\Controllers;

use JetBrains\PhpStorm\NoReturn;
use Knilo\PhpSydProj\DTO\ServiceDTO;
use Knilo\PhpSydProj\Service\BarberService;

class ServiceController
{
    private BarberService $serviceManager;

    public function __construct(BarberService $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function index(): void
    {
        $services = $this->serviceManager->getAllServices();
        include __DIR__ . '/../../../frontend/templates/services/list.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dto = ServiceDTO::fromArray($_POST);
            $this->serviceManager->addService($dto);
            header('Location: /admin/services');
            exit;
        }
        include __DIR__ . '/../../../frontend/templates/services/create.php';
    }

    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dto = ServiceDTO::fromArray($_POST);
            $this->serviceManager->updateService($id, $dto);
            header('Location: /admin/services');
            exit;
        }
        $service = $this->serviceManager->getServiceById($id);
        include __DIR__ . '/../../../frontend/templates/services/edit.php';
    }

    #[NoReturn]
    public function delete(int $id): void
    {
        $this->serviceManager->deleteService($id);
        header('Location: /admin/services');
        exit;
    }
}