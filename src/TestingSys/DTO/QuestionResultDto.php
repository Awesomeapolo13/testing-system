<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

class QuestionResultDto
{
    /**
     * @param int[] $answerIds
     */
    public function __construct(
        public readonly ?int $id,
        public readonly array $answerIds = [],
    ) {
    }
}
