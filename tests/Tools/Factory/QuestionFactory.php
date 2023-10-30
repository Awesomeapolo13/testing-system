<?php

declare(strict_types=1);

namespace App\Tests\Tools\Factory;

use App\TestingSys\Entity\Answer;
use App\TestingSys\Entity\Question;

class QuestionFactory
{
    public static function createFromArray(array $data): Question
    {
        $question = (new Question())
            ->setTitle($data['title']);

        foreach ($data['answers'] as $answer) {
            $question->addAnswer(
                (new Answer())
                    ->setTitle($answer['title'])
                    ->setIsCorrect($answer['isCorrect'])
            );
        }

        return $question;
    }
}
