<?php

declare(strict_types=1);

namespace App\TestingSys\Factory;

use App\TestingSys\Entity\TestResult;

class TestResultFactory
{
    public static function createResult(int $testId, array $result): TestResult
    {
        return (new TestResult())
            ->setTestId($testId)
            ->setResult($result);
    }
}
