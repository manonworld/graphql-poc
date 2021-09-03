<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetRepository::class)
 */
class Planet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Astronaut::class)
     */
    private $astronaunts;

    public function __construct()
    {
        $this->astronaunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Astronaut[]
     */
    public function getAstronaunts(): Collection
    {
        return $this->astronaunts;
    }

    public function addAstronaunt(Astronaut $astronaunt): self
    {
        if (!$this->astronaunts->contains($astronaunt)) {
            $this->astronaunts[] = $astronaunt;
        }

        return $this;
    }

    public function removeAstronaunt(Astronaut $astronaunt): self
    {
        $this->astronaunts->removeElement($astronaunt);

        return $this;
    }
}
