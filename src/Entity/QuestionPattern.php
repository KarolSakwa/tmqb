<?php

namespace App\Entity;

use App\Repository\QuestionPatternRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionPatternRepository::class)]
class QuestionPattern
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questionPatterns')]
    private ?QuestionCategory $category = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'pattern', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $first_record_selector = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $second_record_selector = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $third_record_selector = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $fourth_record_selector = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?QuestionCategory
    {
        return $this->category;
    }

    public function setCategory(?QuestionCategory $category): self
    {
        $this->category = $category;

        return $this;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setPattern($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getPattern() === $this) {
                $question->setPattern(null);
            }
        }

        return $this;
    }

    public function getFirstRecordSelector(): ?string
    {
        return $this->first_record_selector;
    }

    public function setFirstRecordSelector(?string $first_record_selector): self
    {
        $this->first_record_selector = $first_record_selector;

        return $this;
    }

    public function getSecondRecordSelector(): ?string
    {
        return $this->second_record_selector;
    }

    public function setSecondRecordSelector(?string $second_record_selector): self
    {
        $this->second_record_selector = $second_record_selector;

        return $this;
    }

    public function getThirdRecordSelector(): ?string
    {
        return $this->third_record_selector;
    }

    public function setThirdRecordSelector(?string $third_record_selector): self
    {
        $this->third_record_selector = $third_record_selector;

        return $this;
    }

    public function getFourthRecordSelector(): ?string
    {
        return $this->fourth_record_selector;
    }

    public function setFourthRecordSelector(?string $fourth_record_selector): self
    {
        $this->fourth_record_selector = $fourth_record_selector;

        return $this;
    }
}
