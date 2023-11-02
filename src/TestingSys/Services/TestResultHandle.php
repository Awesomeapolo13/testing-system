<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\DTO\QuestionResultDto;
use App\TestingSys\DTO\TestResultDto;
use App\TestingSys\Exception\NonTestResultException;
use App\TestingSys\Exception\TestNotFoundException;
use App\TestingSys\Repository\QuestionRepository;
use App\TestingSys\Repository\TestRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\DBAL\Exception as DBALException;

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
    public function handleResult(TestResultDto $resultDto): void
    {
        $test = $this->testRepository->findTesById($resultDto->testId);
        if (is_null($test)) {
            throw new TestNotFoundException();
        }
        $result = $this->questionRepository->findQuestionResults(
            $test->getId(),
            $this->getAnswerIds($resultDto->questions)
        );

        if (is_null($result)) {
            throw new NonTestResultException();
        }
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
