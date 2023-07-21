<?php

namespace App\Entity;

use App\Repository\RickAndMortyRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: RickAndMortyRepository::class)]
class RickAndMorty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Locations::class, inversedBy: 'rickAndMorties')]
    private Collection $location;

    public function __construct()
    {
        $this->location = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

   /**
    * @return Collection<int, Locations>
    */
   public function getLocation(): Collection
   {
       return $this->location;
   }

   public function addLocation(Locations $location): static
   {
       if (!$this->location->contains($location)) {
           $this->location->add($location);
       }

       return $this;
   }

   public function removeLocation(Locations $location): static
   {
       $this->location->removeElement($location);

       return $this;
   }

}
