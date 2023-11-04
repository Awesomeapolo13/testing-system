<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\Common\Dictionary\DefaultDictionary;
use App\TestingSys\DTO\QuestionResultDto;
use App\TestingSys\DTO\TestResultDto;
use App\TestingSys\Entity\Question;
use App\TestingSys\Entity\Test;
use App\TestingSys\Exception\TestNotFoundException;
use App\TestingSys\Factory\TestResultFactory;
use App\TestingSys\Repository\QuestionRepository;
use App\TestingSys\Repository\TestRepository;
use App\TestingSys\Repository\TestResultRepository;
use Doctrine\DBAL\Exception as DBALException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TestResultHandle
{
    public function __construct(
        private readonly TestRepository $testRepository,
        private readonly QuestionRepository $questionRepository,
        private readonly TestResultRepository $testResultRepo,
    ) {
    }

    /**
     * Обработка результатов теста, их сохранение и возвращение.
     */
    public function handleResult(TestResultDto $resultDto): array
    {
        $testId = $resultDto->testId;
        try {
            $testResult = $this->questionRepository->findQuestionResults(
                $testId,
                $this->getAnswerIds($resultDto->questions)
            );
        } catch (DBALException $exception) {
            throw new HttpException(400, DefaultDictionary::DEFAULT_ERROR_MSG);
        }

        if (is_null($testResult)) {
            throw new TestNotFoundException();
        }

        $this->saveResult($testId, $testResult);

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

    private function saveResult(int $testId, array $result): void
    {
        $this->testResultRepo->save(
            TestResultFactory::createResult($testId, $result)
        );
    }
}
