<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
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
    private $Password;

    /**
     * @ORM\Column(type="integer")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

   

    /**
     * @ORM\Column(type="integer")
     */
    private $Ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RaisonSocial;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compte", mappedBy="Partenaire", cascade={"persist", "remove"})
     */
    private $compte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdminPartenaire", mappedBy="Partenaire")
     */
    private $adminPartenaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserPartenaire", mappedBy="partenaire")
     */
    private $UserPartenaire;

    public function __construct()
    {
        $this->adminPartenaires = new ArrayCollection();
        $this->UserPartenaire = new ArrayCollection();
    }

    

    /* public function __construct()
    {
        $this->AdminPartenaire = new ArrayCollection();
    } */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }


    public function getNinea(): ?int
    {
        return $this->Ninea;
    }

    public function setNinea(int $Ninea): self
    {
        $this->Ninea = $Ninea;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->RaisonSocial;
    }

    public function setRaisonSocial(string $RaisonSocial): self
    {
        $this->RaisonSocial = $RaisonSocial;

        return $this;
    }

    

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(Compte $compte): self
    {
        $this->compte = $compte;

        // set the owning side of the relation if necessary
        if ($this !== $compte->getPartenaire()) {
            $compte->setPartenaire($this);
        }

        return $this;
    }

    /**
     * @return Collection|AdminPartenaire[]
     */
    public function getAdminPartenaires(): Collection
    {
        return $this->adminPartenaires;
    }

    public function addAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if (!$this->adminPartenaires->contains($adminPartenaire)) {
            $this->adminPartenaires[] = $adminPartenaire;
            $adminPartenaire->setPartenaire($this);
        }

        return $this;
    }

    public function removeAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if ($this->adminPartenaires->contains($adminPartenaire)) {
            $this->adminPartenaires->removeElement($adminPartenaire);
            // set the owning side to null (unless already changed)
            if ($adminPartenaire->getPartenaire() === $this) {
                $adminPartenaire->setPartenaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserPartenaire[]
     */
    public function getUserPartenaire(): Collection
    {
        return $this->UserPartenaire;
    }

    public function addUserPartenaire(UserPartenaire $userPartenaire): self
    {
        if (!$this->UserPartenaire->contains($userPartenaire)) {
            $this->UserPartenaire[] = $userPartenaire;
            $userPartenaire->setPartenaire($this);
        }

        return $this;
    }

    public function removeUserPartenaire(UserPartenaire $userPartenaire): self
    {
        if ($this->UserPartenaire->contains($userPartenaire)) {
            $this->UserPartenaire->removeElement($userPartenaire);
            // set the owning side to null (unless already changed)
            if ($userPartenaire->getPartenaire() === $this) {
                $userPartenaire->setPartenaire(null);
            }
        }

        return $this;
    }

    /*  public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }  */
}
