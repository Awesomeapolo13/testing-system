<?php

namespace App\TestingSys\Repository;

use App\TestingSys\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }
    // ToDo: УДалить если не понадобится
//    public function findTestQuestions(int $testId): array
//    {
//        return $this
//            ->createQueryBuilder('q')
//            ->select([
//                'q',
//                'a',
//            ])
//            ->leftJoin('q.answers', 'a')
//            ->where('q.testId = :id')
//            ->setParameter('id', $testId)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
}
