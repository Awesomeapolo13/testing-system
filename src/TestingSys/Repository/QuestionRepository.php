<?php

declare(strict_types=1);

namespace App\TestingSys\Repository;

use App\TestingSys\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    /**
     * @throws DBALException
     */
    public function findQuestionResults(int $testId, array $answerIds): ?array
    {
        $connection = $this->getConnection();
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder
            ->select(
                [
                    'q.id AS "questionId"',
                    'bool_and(a.is_correct) AS "isCorrect"',
                ]
            )
            ->from('question', 'q')
            ->leftJoin(
                'q',
                'answer',
                'a',
                'q.id = a.question_id AND ' . $queryBuilder->expr()->in('a.id', ':answerIds')
            )
            ->where('q.test_id = :testId')
            ->orderBy('q.id')
            ->groupBy('q.id');

        $result = $connection->fetchAllAssociative(
            $queryBuilder->getSQL(),
            [
                'testId' => $testId,
                'answerIds' => $answerIds,
            ],
            [
                'testId' => ParameterType::INTEGER,
                'answerIds' => ArrayParameterType::INTEGER,
            ],
        );

        return $result === [] ? null : $result;
    }

    private function getConnection(): Connection
    {
        return $this->getEntityManager()->getConnection();
    }
}
