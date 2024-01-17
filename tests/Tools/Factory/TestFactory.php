<?php

declare(strict_types=1);

namespace App\Tests\Tools\Factory;

use App\TestingSys\Entity\Test;
use App\Tests\Tools\Provider\QuestionProvider;
use App\Tests\Tools\Provider\TestDataProvider;

class TestFactory
{
    public static function getTestEntity(): Test
    {
        $test = (new Test())
            ->setTitle(TestDataProvider::TEST_TITLE)
            ->setDescription(TestDataProvider::TEST_DESCRIPTION);

        foreach (QuestionProvider::TEST_QUESTIONS as $question) {
            $test->addQuestion(QuestionFactory::createFromArray($question));
        }

        return $test;
    }
}
