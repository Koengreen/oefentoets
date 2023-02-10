<?php

namespace App\Entity;

use App\Entity\Category;
use App\Entity\Pizza;
use App\Repository\BestelregelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BestelregelRepository::class)]
class Bestelregel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $aantal = null;

    #[ORM\ManyToOne(inversedBy: 'bestelregel')]
    private ?Besteling $besteling = null;

    #[ORM\ManyToOne(inversedBy: 'bestelregels')]
    private ?pizza $pizza = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getBesteling(): ?Besteling
    {
        return $this->besteling;
    }

    public function setBesteling(?Besteling $besteling): self
    {
        $this->besteling = $besteling;

        return $this;
    }

    public function getPizza(): ?pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }
}
