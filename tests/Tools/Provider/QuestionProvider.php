<?php

declare(strict_types=1);

namespace App\Tests\Tools\Provider;

use App\TestingSys\Entity\Question;

class QuestionProvider
{
    public const TEST_QUESTIONS = [
        [
            'title' => '1 + 1 = ',
            'answers' => [
                [
                    'id' => 1,
                    'title' => '3',
                    'isCorrect' => false,
                ],
                [
                    'id' => 2,
                    'title' => '2',
                    'isCorrect' => true,
                ],
                [
                    'id' => 3,
                    'title' => '0',
                    'isCorrect' => false,
                ],
            ],
        ],
        [
            'title' => '2 + 2 = ',
            'answers' => [
                [
                    'id' => 4,
                    'title' => '4',
                    'isCorrect' => true,
                ],
                [
                    'id' => 5,
                    'title' => '3 + 1',
                    'isCorrect' => true,
                ],
                [
                    'id' => 6,
                    'title' => '10',
                    'isCorrect' => false,
                ],
            ],
        ],
        [
            'title' => '3 + 3 = ',
            'answers' => [
                [
                    'id' => 7,
                    'title' => '1 + 5',
                    'isCorrect' => false,
                ],
                [
                    'id' => 8,
                    'title' => '1',
                    'isCorrect' => false,
                ],
                [
                    'id' => 9,
                    'title' => '6',
                    'isCorrect' => true,
                ],
                [
                    'title' => '2 + 4',
                    'isCorrect' => false,
                ],
            ],
        ],
        [
            'title' => '4 + 4 = ',
            'answers' => [
                [
                    'id' => 10,
                    'title' => '8',
                    'isCorrect' => true,
                ],
                [
                    'id' => 11,
                    'title' => '4',
                    'isCorrect' => false,
                ],
                [
                    'id' => 12,
                    'title' => '0',
                    'isCorrect' => false,
                ],
                [
                    'id' => 13,
                    'title' => '0 + 8',
                    'isCorrect' => false,
                ],
            ],
        ],
    ];
}
