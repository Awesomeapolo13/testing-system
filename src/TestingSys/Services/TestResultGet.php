<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\DTO\ShowQuestionResDto;
use App\TestingSys\DTO\ShowTestResultDto;
use App\TestingSys\Entity\Question;
use App\TestingSys\Entity\Test;
use App\TestingSys\Exception\TestNotFoundException;
use App\TestingSys\Repository\TestRepository;

class TestResultGet
{
    public function __construct(
        private readonly TestRepository $testRepository,
    ) {
    }

    public function getTestResult(ShowTestResultDto $testResult): array
    {
        $test = $this->testRepository->findTesById($testResult->testId);

        if (is_null($test)) {
            throw new TestNotFoundException();
        }

        return $this->getAnswers($test, $testResult->result);
    }

    /**
     * @param ShowQuestionResDto[] $testResult
     */
    private function getAnswers(Test $test, array $testResult): array
    {
        $result = [
            'correct' => null,
            'wrong' => null,
        ];

        $test->getQuestions()->map(
            function (Question $question) use (&$result, $testResult) {
                foreach ($testResult as $resQuestion) {
                    if ($resQuestion->questionId === $question->getId()) {
                        $resQuestion->isCorrect
                            ? $result['correct'][] = $question
                            : $result['wrong'][] = $question;
                    }
                }
            }
        );

        return $result;
    }
}
