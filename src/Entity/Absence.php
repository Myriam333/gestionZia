<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbsenceRepository")
 */
class Absence
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
    private $debut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salarie", inversedBy="absences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salarie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?string
    {
        return $this->debut;
    }

    public function setDebut(string $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?string
    {
        return $this->fin;
    }

    public function setFin(string $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getSalarie(): ?Salarie
    {
        return $this->salarie;
    }

    public function setSalarie(?Salarie $salarie): self
    {
        $this->salarie = $salarie;

        return $this;
    }
}
