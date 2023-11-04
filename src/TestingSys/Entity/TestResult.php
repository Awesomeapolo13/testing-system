<?php

declare(strict_types=1);

namespace App\TestingSys\Entity;

use App\TestingSys\Repository\TestResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestResultRepository::class)]
class TestResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $testId = null;

    #[ORM\Column]
    private array $result = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestId(): ?int
    {
        return $this->testId;
    }

    public function setTestId(int $testId): static
    {
        $this->testId = $testId;

        return $this;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): static
    {
        $this->result = $result;

        return $this;
    }
}
