<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'activity', targetEntity: InfoUser::class)]
    private Collection $infoUsers;

    public function __construct()
    {
        $this->infoUsers = new ArrayCollection();
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
            $infoUser->setActivity($this);
        }

        return $this;
    }

    public function removeInfoUser(InfoUser $infoUser): self
    {
        if ($this->infoUsers->removeElement($infoUser)) {
            // set the owning side to null (unless already changed)
            if ($infoUser->getActivity() === $this) {
                $infoUser->setActivity(null);
            }
        }

        return $this;
    }
}
