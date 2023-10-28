<?php

namespace App\TestingSys\Entity;

use App\TestingSys\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class)]
    private Collection $answers;

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
}
