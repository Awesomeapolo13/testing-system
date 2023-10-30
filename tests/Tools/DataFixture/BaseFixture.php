<?php

declare(strict_types=1);

namespace Tools\DataFixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    protected Generator $faker;
    protected ObjectManager $manager;
    protected array $referencesIndex =[];

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->manager = $manager;

        $this->loadData($manager);
    }

    abstract public function loadData(ObjectManager $manager): void;

    protected function create(string $className, callable $factory): object
    {
        $entity = new $className();
        $factory($entity);
        $this->manager->persist($entity);

        return $entity;
    }

    protected function getRandomReference(string $className): object
    {
        // Если данные внутри класса уже есть, если нет то заходит внутрь
        if (!isset($this->referencesIndex[$className])) {
            $this->referencesIndex[$className] = [];
            // выбираем все связи из объекта referenceRepository
            foreach ($this->referenceRepository->getReferences() as $key => $reference) {
                // проверяем содержит ли ключ этой связи имя класса
                if (str_starts_with($key, $className . '|')) {
                    // если да то собираем массив из элементов, указывающих на нужный класс
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }
        // если referencesIndex пустой, то исключение
        if (empty($this->referencesIndex[$className])) {
            throw new Exception('Не найдены ссылки на класс ' . $className);
        }

        return $this->getReference($this->faker->randomElement($this->referencesIndex[$className]));
    }
}
