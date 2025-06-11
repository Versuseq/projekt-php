<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Name = null;

    /**
     * @var Collection<int, Dish>
     */
    #[ORM\OneToMany(targetEntity: Dish::class, mappedBy: 'Section')]
    private Collection $Dishes;

    public function __construct()
    {
        $this->Dishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDishes(): Collection
    {
        return $this->Dishes;
    }

    public function addDish(Dish $dish): static
    {
        if (!$this->Dishes->contains($dish)) {
            $this->Dishes->add($dish);
            $dish->setSection($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): static
    {
        if ($this->Dishes->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getSection() === $this) {
                $dish->setSection(null);
            }
        }

        return $this;
    }
}
