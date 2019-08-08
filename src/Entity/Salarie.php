<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalarieRepository")
 */
class Salarie
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paysNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitulePoste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePoste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dureePoste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horairesHebdo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $totalTeletravail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Absence", mappedBy="salarie", orphanRemoval=true)
     */
    private $absences;

    public function __toString()
    {
        return $this->nom;
    }
    public function __construct()
    {
        $this->absences = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVilleNaissance(): ?string
    {
        return $this->villeNaissance;
    }

    public function setVilleNaissance(string $villeNaissance): self
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(string $paysNaissance): self
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    

    

   

    public function getIntitulePoste(): ?string
    {
        return $this->intitulePoste;
    }

    public function setIntitulePoste(string $intitulePoste): self
    {
        $this->intitulePoste = $intitulePoste;

        return $this;
    }

    public function getTypePoste(): ?string
    {
        return $this->typePoste;
    }

    public function setTypePoste(string $typePoste): self
    {
        $this->typePoste = $typePoste;

        return $this;
    }

    public function getDureePoste(): ?string
    {
        return $this->dureePoste;
    }

    public function setDureePoste(string $dureePoste): self
    {
        $this->dureePoste = $dureePoste;

        return $this;
    }

    public function getHorairesHebdo(): ?string
    {
        return $this->horairesHebdo;
    }

    public function setHorairesHebdo(string $horairesHebdo): self
    {
        $this->horairesHebdo = $horairesHebdo;

        return $this;
    }

    public function getTotalTeletravail(): ?string
    {
        return $this->totalTeletravail;
    }

    public function setTotalTeletravail(string $totalTeletravail): self
    {
        $this->totalTeletravail = $totalTeletravail;

        return $this;
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setSalarie($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getSalarie() === $this) {
                $absence->setSalarie(null);
            }
        }

        return $this;
    }
}
