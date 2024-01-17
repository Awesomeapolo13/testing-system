<?php

declare(strict_types=1);

namespace App\TestingSys\Dictionary;

class ValidationDictionary
{
    public const EMPTY_TEST_ID_MSG = 'Отсутствует testId';
    public const EMPTY_QUESTION_MSG = 'Отсутствуют результаты теста';
    public const EMPTY_TEST_QUESTION_ID_MSG = 'Отсутствует id вопроса';
    public const WRONG_ANSWERS_TYPE_MSG = 'Идентификаторы ответов должны быть числом';
}
