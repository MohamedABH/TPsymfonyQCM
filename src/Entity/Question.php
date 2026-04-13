<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    /**
     * @var Collection<int, Answer>
     */
    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question', orphanRemoval: true, cascade: ['persist'])]
    private Collection $answers;

    /**
     * @var Collection<int, Quizz>
     */
    #[ORM\ManyToMany(targetEntity: Quizz::class, inversedBy: 'questions')]
    private Collection $quizz;


    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->quizz = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizz(): Collection
    {
        return $this->quizz;
    }

    public function addQuizz(Quizz $quizz): static
    {
        if (!$this->quizz->contains($quizz)) {
            $this->quizz->add($quizz);
        }

        return $this;
    }

    public function removeQuizz(Quizz $quizz): static
    {
        $this->quizz->removeElement($quizz);

        return $this;
    }

}
