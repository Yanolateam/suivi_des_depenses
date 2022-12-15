<?php

namespace App\Entity;

use App\Repository\InfoUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoUserRepository::class)]
class InfoUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $depense = null;

    #[ORM\ManyToOne(inversedBy: 'infoUsers')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'infoUsers')]
    private ?Location $location = null;

    #[ORM\ManyToOne(inversedBy: 'infoUsers')]
    private ?Activity $activity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepense(): ?string
    {
        return $this->depense;
    }

    public function setDepense(string $depense): self
    {
        $this->depense = $depense;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
