<?php

declare(strict_types=1);

namespace App\Tests\Tools\DataFixture;

use App\Tests\Tools\Factory\TestFactory;
use Doctrine\Persistence\ObjectManager;

class TestFixture extends BaseFixture
{

    public function loadData(ObjectManager $manager): void
    {
        $manager->persist(TestFactory::getTestEntity());
        $manager->flush();
    }
}
