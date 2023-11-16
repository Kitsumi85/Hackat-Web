<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ ORM\DiscriminatorMap(['Atelier' => Atelier::class, 'Conference' => Conference::class])]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descrription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $durée = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $salle = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hackaton $UnHackaton = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrription(): ?string
    {
        return $this->descrription;
    }

    public function setDescrription(string $descrription): static
    {
        $this->descrription = $descrription;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(?\DateTimeInterface $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDurée(): ?string
    {
        return $this->durée;
    }

    public function setDurée(?string $durée): static
    {
        $this->durée = $durée;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getUnHackaton(): ?Hackaton
    {
        return $this->UnHackaton;
    }

    public function setUnHackaton(?Hackaton $UnHackaton): static
    {
        $this->UnHackaton = $UnHackaton;

        return $this;
    }
}
