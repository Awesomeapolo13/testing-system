<?php

declare(strict_types=1);

namespace App\Common\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route(path: '/health-check', methods: 'GET', name: 'app_health_check')]
    public function healthCheckAction(): JsonResponse
    {
        return $this->json(['success' => true]);
    }
}
