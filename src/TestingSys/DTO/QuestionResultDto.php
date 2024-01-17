<?php

declare(strict_types=1);

namespace App\TestingSys\DTO;

use App\TestingSys\Dictionary\ValidationDictionary;
use Symfony\Component\Validator\Constraints as Assert;

readonly class QuestionResultDto
{
    /**
     * @param int[] $answerIds
     */
    public function __construct(
        #[Assert\NotBlank(message: ValidationDictionary::EMPTY_TEST_QUESTION_ID_MSG)]
        public ?int $id,
        // Делаем проверку на числовое значение таким образом, т.к. из формы число может придти строкой.
        #[Assert\All(
            [new Assert\Regex('/^\d+$/', message: ValidationDictionary::WRONG_ANSWERS_TYPE_MSG)]
        )]
        public array $answerIds = [],
    ) {
    }
}
