<?php

namespace App\Entity;

use App\Repository\UserDepenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserDepenseRepository::class)]
class UserDepense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 9, scale: 2)]
    private ?string $montant = null;

    #[ORM\Column]
    private ?bool $engagement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedeprelevement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datefinengagement = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255)]
    private ?string $frequence = null;

    #[ORM\ManyToOne(inversedBy: 'userDepenses')]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'userDepenses')]
    private ?User $user = null;

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function isEngagement(): ?bool
    {
        return $this->engagement;
    }

    public function setEngagement(bool $engagement): self
    {
        $this->engagement = $engagement;

        return $this;
    }

    public function getDatedeprelevement(): ?\DateTimeInterface
    {
        return $this->datedeprelevement;
    }

    public function setDatedeprelevement(\DateTimeInterface $datedeprelevement): self
    {
        $this->datedeprelevement = $datedeprelevement;

        return $this;
    }

    public function getDatefinengagement(): ?\DateTimeInterface
    {
        return $this->datefinengagement;
    }

    public function setDatefinengagement(\DateTimeInterface $datefinengagement): self
    {
        $this->datefinengagement = $datefinengagement;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getFrequence(): ?string
    {
        return $this->frequence;
    }

    public function setFrequence(string $frequence): self
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

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
}
