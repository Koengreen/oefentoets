<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Besteling;

#[ORM\Entity(repositoryClass: KlantRepository::class)]
class Klant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    #[ORM\Column(length: 255)]
    private ?string $adres = null;

    #[ORM\Column(length: 255)]
    private ?string $postcode = null;

    #[ORM\Column(length: 255)]
    private ?string $woonplaats = null;

    #[ORM\OneToMany(mappedBy: 'klant', targetEntity: besteling::class)]
    private Collection $bestelling;

    public function __construct()
    {
        $this->bestelling = new ArrayCollection();
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

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * @return Collection<int, besteling>
     */
    public function getBestelling(): Collection
    {
        return $this->bestelling;
    }

    public function addBestelling(besteling $bestelling): self
    {
        if (!$this->bestelling->contains($bestelling)) {
            $this->bestelling->add($bestelling);
            $bestelling->setKlant($this);
        }

        return $this;
    }

    public function removeBestelling(besteling $bestelling): self
    {
        if ($this->bestelling->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getKlant() === $this) {
                $bestelling->setKlant(null);
            }
        }

        return $this;
    }
}
