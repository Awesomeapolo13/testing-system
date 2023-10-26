<?php

declare(strict_types=1);

namespace App\TestingSys\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(path: '/', methods: 'GET', name: 'app_testing_start_page')]
    public function getStartPageAction(): Response
    {
        return $this->render(
            'testing_sys/main.html.twig',
        );
    }
}
