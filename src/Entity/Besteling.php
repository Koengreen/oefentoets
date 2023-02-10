<?php

namespace App\Entity;

use App\Repository\BestelingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BestelingRepository::class)]
class Besteling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $datum = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'bestelling')]
    private ?Klant $klant = null;

    #[ORM\OneToMany(mappedBy: 'besteling', targetEntity: Bestelregel::class)]
    private Collection $bestelregel;

    public function __construct()
    {
        $this->bestelregel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?string
    {
        return $this->datum;
    }

    public function setDatum(string $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getKlant(): ?Klant
    {
        return $this->klant;
    }

    public function setKlant(?Klant $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    /**
     * @return Collection<int, bestelregel>
     */
    public function getBestelregel(): Collection
    {
        return $this->bestelregel;
    }

    public function addBestelregel(bestelregel $bestelregel): self
    {
        if (!$this->bestelregel->contains($bestelregel)) {
            $this->bestelregel->add($bestelregel);
            $bestelregel->setBesteling($this);
        }

        return $this;
    }

    public function removeBestelregel(bestelregel $bestelregel): self
    {
        if ($this->bestelregel->removeElement($bestelregel)) {
            // set the owning side to null (unless already changed)
            if ($bestelregel->getBesteling() === $this) {
                $bestelregel->setBesteling(null);
            }
        }

        return $this;
    }
}
