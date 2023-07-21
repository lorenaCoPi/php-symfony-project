<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationsRepository::class)]
class Locations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: RickAndMorty::class, mappedBy: 'location')]
    private Collection $rickAndMorties;

    public function __construct()
    {
        $this->rickAndMorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, RickAndMorty>
     */
    public function getRickAndMorties(): Collection
    {
        return $this->rickAndMorties;
    }

    public function addRickAndMorty(RickAndMorty $rickAndMorty): static
    {
        if (!$this->rickAndMorties->contains($rickAndMorty)) {
            $this->rickAndMorties->add($rickAndMorty);
            $rickAndMorty->addLocation($this);
        }

        return $this;
    }

    public function removeRickAndMorty(RickAndMorty $rickAndMorty): static
    {
        if ($this->rickAndMorties->removeElement($rickAndMorty)) {
            $rickAndMorty->removeLocation($this);
        }

        return $this;
    }
}
