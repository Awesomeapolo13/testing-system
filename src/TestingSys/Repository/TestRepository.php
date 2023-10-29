<?php

namespace App\TestingSys\Repository;

use App\TestingSys\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class TestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function getTestList(): array
    {
        return $this
            ->createQueryBuilder('t')
            ->select('t')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findTesById(int $testId): ?Test
    {
        return $this
            ->createQueryBuilder('t')
            ->select([
                't',
                'q',
                'a',
            ])
            ->leftJoin('t.questions', 'q')
            ->leftJoin('q.answers', 'a')
            ->where('t.id = :id')
            ->setParameter('id', $testId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
