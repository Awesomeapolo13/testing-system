<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

class ShowQuestionResDto
{
    public function __construct(
        public readonly ?int $questionId,
        public readonly bool $isCorrect = false,
    ) {
    }
}
