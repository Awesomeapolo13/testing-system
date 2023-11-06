<?php

declare(strict_types=1);

namespace App\TestingSys\Entity;

use App\TestingSys\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    #[Groups(['result'])]
    private ?string $title = null;
    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, cascade: ['persist'])]
    private Collection $answers;
    #[ORM\ManyToOne(targetEntity: Test::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Test $test = null;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answers): static
    {
        if (!$this->answers->contains($answers)) {
            $this->answers->add($answers);
            $answers->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answers): static
    {
        if ($this->answers->removeElement($answers)) {
            // set the owning side to null (unless already changed)
            if ($answers->getQuestion() === $this) {
                $answers->setQuestion(null);
            }
        }

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): static
    {
        $this->test = $test;

        return $this;
    }
}
