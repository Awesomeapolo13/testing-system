<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

class QuestionResultDto
{
    /**
     * @param int[] $answerIds
     */
    public function __construct(
        private readonly ?int $id,
        private readonly array $answerIds = [],
    ) {
    }
}
