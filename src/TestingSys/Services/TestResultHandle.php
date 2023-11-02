<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\DTO\QuestionResultDto;
use App\TestingSys\DTO\TestResultDto;
use App\TestingSys\Entity\Question;
use App\TestingSys\Entity\Test;
use App\TestingSys\Exception\TestNotFoundException;
use App\TestingSys\Repository\QuestionRepository;
use App\TestingSys\Repository\TestRepository;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\NonUniqueResultException;

class TestResultHandle
{
    public function __construct(
        private readonly TestRepository $testRepository,
        private readonly QuestionRepository $questionRepository,
    ) {
    }

    /**
     * @throws NonUniqueResultException|DBALException
     */
    public function handleResult(TestResultDto $resultDto): array
    {
        // ToDo: Подумать надо ли вообще это всё тут.
        $test = $this->testRepository->findTesById($resultDto->testId);
        if (is_null($test)) {
            throw new TestNotFoundException();
        }
        $testResult = $this->questionRepository->findQuestionResults(
            $resultDto->testId,
            $this->getAnswerIds($resultDto->questions)
        );

        if (is_null($testResult)) {
            throw new TestNotFoundException();
        }

        return $testResult;
    }

    private function getAnswers(Test $test, array $testResult): array
    {
        $result = [
            'correct' => null,
            'wrong' => null,
        ];

        $test->getQuestions()->map(
            function (Question $question) use (&$result, $testResult) {
                foreach ($testResult as $resQuestion) {
                    $resQuestion['questionId'] === $question->getId()
                    && $resQuestion['is_correct']
                        ? $result['correct'] = $question
                        : $result['wrong'] = $question;
                }
            }
        );

        return $result;
    }

    private function getAnswerIds(array $questionDtoList): array
    {
        $answerIds = [];
        array_map(
            function (QuestionResultDto $questionResult) use (&$answerIds): void {
                $answerIds = array_merge($answerIds, $questionResult->answerIds);
            },
            $questionDtoList
        );

        return $answerIds;
    }
}
