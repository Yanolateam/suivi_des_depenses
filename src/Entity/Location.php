<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: InfoUser::class)]
    private Collection $infoUsers;

    public function __construct()
    {
        $this->infoUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, InfoUser>
     */
    public function getInfoUsers(): Collection
    {
        return $this->infoUsers;
    }

    public function addInfoUser(InfoUser $infoUser): self
    {
        if (!$this->infoUsers->contains($infoUser)) {
            $this->infoUsers->add($infoUser);
            $infoUser->setLocation($this);
        }

        return $this;
    }

    public function removeInfoUser(InfoUser $infoUser): self
    {
        if ($this->infoUsers->removeElement($infoUser)) {
            // set the owning side to null (unless already changed)
            if ($infoUser->getLocation() === $this) {
                $infoUser->setLocation(null);
            }
        }

        return $this;
    }
}
