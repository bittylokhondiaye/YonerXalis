<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroCompte;

    /**
     * @ORM\Column(type="text")
     */
    private $NomProprietaire;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="integer")
     */
    private $Montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $CNIproprietaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Partenaire", inversedBy="compte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Partenaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?int
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(int $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }

    public function getNomProprietaire(): ?string
    {
        return $this->NomProprietaire;
    }

    public function setNomProprietaire(string $NomProprietaire): self
    {
        $this->NomProprietaire = $NomProprietaire;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->Montant;
    }

    public function setMontant(int $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getCNIproprietaire(): ?int
    {
        return $this->CNIproprietaire;
    }

    public function setCNIproprietaire(int $CNIproprietaire): self
    {
        $this->CNIproprietaire = $CNIproprietaire;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->Partenaire;
    }

    public function setPartenaire(Partenaire $Partenaire): self
    {
        $this->Partenaire = $Partenaire;

        return $this;
    }
}
