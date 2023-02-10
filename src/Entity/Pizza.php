<?php

namespace App\Entity;

use App\Entity\Category;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'pizza', targetEntity: Bestelregel::class)]
    private Collection $bestelregels;

    #[ORM\ManyToOne(inversedBy: 'pizzas')]
    private ?category $category = null;

    public function __construct()
    {
        $this->bestelregels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Bestelregel>
     */
    public function getBestelregels(): Collection
    {
        return $this->bestelregels;
    }

    public function addBestelregel(Bestelregel $bestelregel): self
    {
        if (!$this->bestelregels->contains($bestelregel)) {
            $this->bestelregels->add($bestelregel);
            $bestelregel->setPizza($this);
        }

        return $this;
    }

    public function removeBestelregel(Bestelregel $bestelregel): self
    {
        if ($this->bestelregels->removeElement($bestelregel)) {
            // set the owning side to null (unless already changed)
            if ($bestelregel->getPizza() === $this) {
                $bestelregel->setPizza(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
