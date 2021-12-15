<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarteRepository::class)
 */
class Carte
{
    const TYPE_DEBIT = 'Débit';
    const TYPE_CREDIT = 'Crédit';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="date")
     */
    private $dateExpiration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatBloque;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getEtatBloque(): ?bool
    {
        return $this->etatBloque;
    }

    public function setEtatBloque(?bool $etatBloque): self
    {
        $this->etatBloque = $etatBloque;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

}
