<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DishRepository::class)]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $en_us_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $en_us_description = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\ManyToOne(inversedBy: 'Dishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Section $Section = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'Dishes')]
    private Collection $Category;

    #[ORM\Column(length: 255)]
    private ?string $pl_pl_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pl_pl_description = null;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnUsName(): ?string
    {
        return $this->en_us_name;
    }

    public function setEnUsName(string $en_us_name): static
    {
        $this->en_us_name = $en_us_name;

        return $this;
    }

    public function getEnUsDescription(): ?string
    {
        return $this->en_us_description;
    }

    public function setEnUsDescription(?string $en_us_description): static
    {
        $this->en_us_description = $en_us_description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->Section;
    }

    public function setSection(?Section $Section): static
    {
        $this->Section = $Section;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->Category->contains($category)) {
            $this->Category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->Category->removeElement($category);

        return $this;
    }

    public function getPlPlName(): ?string
    {
        return $this->pl_pl_name;
    }

    public function setPlPlName(string $pl_pl_name): static
    {
        $this->pl_pl_name = $pl_pl_name;

        return $this;
    }

    public function getPlPlDescription(): ?string
    {
        return $this->pl_pl_description;
    }

    public function setPlPlDescription(string $pl_pl_description): static
    {
        $this->pl_pl_description = $pl_pl_description;

        return $this;
    }
}
