<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SuperAdminRepository")
 */
class SuperAdmin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MotDePasse;

    /**
     * @ORM\Column(type="text")
     */
    private $Prenom;

    /**
     * @ORM\Column(type="text")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $CNI;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partenaire", mappedBy="superAdmin")
     */
    private $Partenaire;

    public function __construct()
    {
        $this->Partenaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->Login;
    }

    public function setLogin(string $Login): self
    {
        $this->Login = $Login;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): self
    {
        $this->MotDePasse = $MotDePasse;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getCNI(): ?int
    {
        return $this->CNI;
    }

    public function setCNI(int $CNI): self
    {
        $this->CNI = $CNI;

        return $this;
    }

    /**
     * @return Collection|Partenaire[]
     */
    public function getPartenaire(): Collection
    {
        return $this->Partenaire;
    }

    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->Partenaire->contains($partenaire)) {
            $this->Partenaire[] = $partenaire;
            $partenaire->setSuperAdmin($this);
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): self
    {
        if ($this->Partenaire->contains($partenaire)) {
            $this->Partenaire->removeElement($partenaire);
            // set the owning side to null (unless already changed)
            if ($partenaire->getSuperAdmin() === $this) {
                $partenaire->setSuperAdmin(null);
            }
        }

        return $this;
    }
}
