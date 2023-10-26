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

    #[Route(path: '/test', methods: 'GET', name: 'app_test_page')]
    public function getTest(): Response
    {
        return $this->render(
            'testing_sys/test.html.twig',
            [
                'test' => [
                    [
                        'label' => '1 + 1 = ',
                        'answers' => [
                            [
                                '3' => false,
                            ],
                            [
                                '2' => false,
                            ],
                            [
                                '0' => false,
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'label' => '2 + 2 = ',
                        'answers' => [
                            [
                                'name' => '4',
                                'selected' => false,
                            ],
                            [
                                'name' => '3 + 1',
                                'selected' => false,
                            ],
                            [
                                'name' => '10',
                                'selected' => false,
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'label' => '3 + 3 = ',
                        'answers' => [
                            [
                                'name' => '1 + 5',
                                'selected' => false,
                            ],
                            [
                                'name' => '1',
                                'selected' => false,
                            ],
                            [
                                'name' => '6',
                                'selected' => false,
                            ],
                            [
                                'name' => '2 + 4',
                                'selected' => false,
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'label' => '4 + 4 = ',
                        'answers' => [
                            [
                                'name' => '8',
                                'selected' => false,
                            ],
                            [
                                'name' => '4',
                                'selected' => false,
                            ],
                            [
                                'name' => '0',
                                'selected' => false,
                            ],
                            [
                                'name' => '0 + 8',
                                'selected' => false,
                            ],
                        ],
                        'correct' => null,
                    ],
                ],
            ]
        );
    }
}
