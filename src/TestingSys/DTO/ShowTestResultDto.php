<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

use App\TestingSys\Dictionary\ValidationDictionary;
use Symfony\Component\Validator\Constraints as Assert;

readonly class ShowTestResultDto
{
    /**
     * @param ShowQuestionResDto[] $result
     */
    public function __construct(
        #[Assert\NotBlank(message: ValidationDictionary::EMPTY_TEST_ID_MSG)]
        public ?int $testId,
        #[Assert\Valid]
        public array $result = [],
    ) {
    }
}
