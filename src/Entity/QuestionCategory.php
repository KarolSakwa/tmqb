<?php

namespace App\Entity;

use App\Repository\QuestionCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionCategoryRepository::class)]
class QuestionCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: QuestionPattern::class)]
    private Collection $questionPatterns;

    public function __construct()
    {
        $this->questionPatterns = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, QuestionPattern>
     */
    public function getQuestionPatterns(): Collection
    {
        return $this->questionPatterns;
    }

    public function addQuestionPattern(QuestionPattern $questionPattern): self
    {
        if (!$this->questionPatterns->contains($questionPattern)) {
            $this->questionPatterns->add($questionPattern);
            $questionPattern->setCategory($this);
        }

        return $this;
    }

    public function removeQuestionPattern(QuestionPattern $questionPattern): self
    {
        if ($this->questionPatterns->removeElement($questionPattern)) {
            // set the owning side to null (unless already changed)
            if ($questionPattern->getCategory() === $this) {
                $questionPattern->setCategory(null);
            }
        }

        return $this;
    }
}
