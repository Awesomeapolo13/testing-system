<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\Entity\Test;
use App\TestingSys\Repository\QuestionRepository;
use App\TestingSys\Repository\TestRepository;

class TestGet
{
    public function __construct(
        private readonly TestRepository $testRepository,
        private readonly QuestionRepository $questionRepository,
    ) {
    }

    /**
     * @return Test[]
     */
    public function getTestList(): array
    {
        return $this->testRepository->getTestList();
    }

    public function getTest(int $testId): ?Test
    {
        $test = $this->testRepository->findTesById($testId);

        return $test;
        //
        //        return [
        //            'id' => 1,
        //            [
        //                'id' => 1,
        //                'title' => '1 + 1 = ',
        //                'answers' => [
        //                    [
        //                        'id' => 1,
        //                        'title' => '3',
        //                    ],
        //                    [
        //                        'id' => 2,
        //                        'title' => '2',
        //                    ],
        //                    [
        //                        'id' => 3,
        //                        'title' => '0',
        //                    ],
        //                ],
        //            ],
        //            [
        //                'id' => 2,
        //                'title' => '2 + 2 = ',
        //                'answers' => [
        //                    [
        //                        'id' => 4,
        //                        'title' => '4',
        //                    ],
        //                    [
        //                        'id' => 5,
        //                        'title' => '3 + 1',
        //                    ],
        //                    [
        //                        'id' => 6,
        //                        'title' => '10',
        //                    ],
        //                ],
        //            ],
        //            [
        //                'id' => 3,
        //                'title' => '3 + 3 = ',
        //                'answers' => [
        //                    [
        //                        'id' => 7,
        //                        'title' => '1 + 5',
        //                    ],
        //                    [
        //                        'id' => 8,
        //                        'title' => '1',
        //                    ],
        //                    [
        //                        'id' => 9,
        //                        'title' => '6',
        //                    ],
        //                    [
        //                        'title' => '2 + 4',
        //                    ],
        //                ],
        //            ],
        //            [
        //                'id' => 4,
        //                'title' => '4 + 4 = ',
        //                'answers' => [
        //                    [
        //                        'id' => 10,
        //                        'title' => '8',
        //                    ],
        //                    [
        //                        'id' => 11,
        //                        'title' => '4',
        //                    ],
        //                    [
        //                        'id' => 12,
        //                        'title' => '0',
        //                    ],
        //                    [
        //                        'id' => 13,
        //                        'title' => '0 + 8',
        //                    ],
        //                ],
        //            ],
        //        ];
    }
}
