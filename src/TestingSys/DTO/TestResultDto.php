<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

class TestResultDto
{
    /**
     * @param QuestionResultDto[] $questions
     */
    public function __construct(
        public readonly ?int $testId,
        public readonly array $questions = [],
    ) {
    }
}
