<?php

declare(strict_types=1);

namespace App\TestingSys\Services;

use App\TestingSys\Entity\Test;
use App\TestingSys\Repository\TestRepository;
use Doctrine\ORM\NonUniqueResultException;

class TestGet
{
    public function __construct(
        private readonly TestRepository $testRepository,
    ) {
    }

    /**
     * @return Test[]
     */
    public function getTestList(): array
    {
        return $this->testRepository->getTestList();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getTest(int $testId): ?Test
    {
        return $this->testRepository->findTesById($testId);
    }
}
