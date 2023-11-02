<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

class ShowTestResultDto
{
    /**
     * @param ShowQuestionResDto[] $result
     */
    public function __construct(
        public readonly ?int $testId,
        public readonly array $result = [],
    ) {
    }
}
