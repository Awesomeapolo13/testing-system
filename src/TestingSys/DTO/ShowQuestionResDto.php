<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

use App\TestingSys\Dictionary\ValidationDictionary;
use Symfony\Component\Validator\Constraints as Assert;

readonly class ShowQuestionResDto
{
    public function __construct(
        #[Assert\NotBlank(message: ValidationDictionary::EMPTY_TEST_QUESTION_ID_MSG)]
        public ?int $questionId,
        #[Assert\NotNull(message: ValidationDictionary::EMPTY_IS_CORRECT_MSG)]
        public ?bool $isCorrect = false,
    ) {
    }
}
