<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2000)]
    private ?string $text = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?QuestionPattern $pattern = null;

    #[ORM\Column(length: 255)]
    private ?string $answer_a = null;

    #[ORM\Column(length: 255)]
    private ?string $answer_b = null;

    #[ORM\Column(length: 255)]
    private ?string $answer_c = null;

    #[ORM\Column(length: 255)]
    private ?string $answer_d = null;

    #[ORM\Column(length: 255)]
    private ?string $correct_answer = null;

    #[ORM\Column(nullable: true)]
    private ?float $difficulty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPattern(): ?QuestionPattern
    {
        return $this->pattern;
    }

    public function setPattern(?QuestionPattern $pattern): self
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function getAnswerA(): ?string
    {
        return $this->answer_a;
    }

    public function setAnswerA(string $answer_a): self
    {
        $this->answer_a = $answer_a;

        return $this;
    }

    public function getAnswerB(): ?string
    {
        return $this->answer_b;
    }

    public function setAnswerB(string $answer_b): self
    {
        $this->answer_b = $answer_b;

        return $this;
    }

    public function getAnswerC(): ?string
    {
        return $this->answer_c;
    }

    public function setAnswerC(string $answer_c): self
    {
        $this->answer_c = $answer_c;

        return $this;
    }

    public function getAnswerD(): ?string
    {
        return $this->answer_d;
    }

    public function setAnswerD(string $answer_d): self
    {
        $this->answer_d = $answer_d;

        return $this;
    }

    public function getCorrectAnswer(): ?string
    {
        return $this->correct_answer;
    }

    public function setCorrectAnswer(string $correct_answer): self
    {
        $this->correct_answer = $correct_answer;

        return $this;
    }

    public function getDifficulty(): ?float
    {
        return $this->difficulty;
    }

    public function setDifficulty(?float $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }
}
