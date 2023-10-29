<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\Entity\Test;
use App\TestingSys\Repository\TestRepository;

class TestGet
{
    public function __construct(
        private readonly TestRepository $testRepository,
    ) {
    }

    /**
     * @return Test[]
     */
    public function getTestList(): array
    {
        return $this->testRepository->getTestList();
    }

    public function getTest(int $testId): array
    {
        return [
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
        ];
    }
}
