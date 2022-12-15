<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'fournisseurs')]
    private Collection $categorie;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: UserDepense::class)]
    private Collection $userDepenses;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->userDepenses = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, UserDepense>
     */
    public function getUserDepenses(): Collection
    {
        return $this->userDepenses;
    }

    public function addUserDepense(UserDepense $userDepense): self
    {
        if (!$this->userDepenses->contains($userDepense)) {
            $this->userDepenses->add($userDepense);
            $userDepense->setFournisseur($this);
        }

        return $this;
    }

    public function removeUserDepense(UserDepense $userDepense): self
    {
        if ($this->userDepenses->removeElement($userDepense)) {
            // set the owning side to null (unless already changed)
            if ($userDepense->getFournisseur() === $this) {
                $userDepense->setFournisseur(null);
            }
        }

        return $this;
    }
}
