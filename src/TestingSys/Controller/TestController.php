<?php

declare(strict_types=1);

namespace App\TestingSys\Controller;

use App\TestingSys\Services\TestGet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(path: '/', methods: 'GET', name: 'app_testing_list_page')]
    public function getStartPageAction(TestGet $testGet): Response
    {
        return $this->render(
            'testing_sys/main.html.twig',
            [
                'testList' => $testGet->getTestList(),
            ]
        );
    }

    #[Route(path: '/test/{id}/', methods: 'GET', name: 'app_test_page')]
    public function getTest(int $testId, TestGet $testGet): Response
    {
        return $this->render(
            'testing_sys/test.html.twig',
            ['test' => $testGet->getTest($testId)]
        );
    }
}
