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
                        'id' => 1,
                        'title' => '1 + 1 = ',
                        'answers' => [
                            [
                                'title' => '3',
                            ],
                            [
                                'title' => '2',
                            ],
                            [
                                'title' => '0',
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'id' => 2,
                        'title' => '2 + 2 = ',
                        'answers' => [
                            [
                                'title' => '4',
                            ],
                            [
                                'title' => '3 + 1',
                            ],
                            [
                                'title' => '10',
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'id' => 3,
                        'title' => '3 + 3 = ',
                        'answers' => [
                            [
                                'title' => '1 + 5',
                            ],
                            [
                                'title' => '1',
                            ],
                            [
                                'title' => '6',
                            ],
                            [
                                'title' => '2 + 4',
                            ],
                        ],
                        'correct' => null,
                    ],
                    [
                        'id' => 1,
                        'title' => '4 + 4 = ',
                        'answers' => [
                            [
                                'title' => '8',
                            ],
                            [
                                'title' => '4',
                            ],
                            [
                                'title' => '0',
                            ],
                            [
                                'title' => '0 + 8',
                            ],
                        ],
                        'correct' => null,
                    ],
                ],
            ]
        );
    }
}
