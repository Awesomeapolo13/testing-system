<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

use App\TestingSys\Dictionary\ValidationDictionary;
use Symfony\Component\Validator\Constraints as Assert;

readonly class TestResultDto
{
    /**
     * @param QuestionResultDto[] $questions
     */
    public function __construct(
        #[Assert\NotBlank(message: ValidationDictionary::EMPTY_TEST_ID_MSG)]
        public ?int $testId,
        #[Assert\NotBlank(message: ValidationDictionary::EMPTY_QUESTION_MSG)]
        #[Assert\Valid]
        public array $questions = [],
    ) {
    }
}
