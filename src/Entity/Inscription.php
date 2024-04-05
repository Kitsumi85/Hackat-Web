<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'num_insc')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_insc = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $leCompte = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hackaton $UnHackaton = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInsc(): ?\DateTimeInterface
    {
        return $this->date_insc;
    }

    public function setDateInsc(\DateTimeInterface $date_insc): static
    {
        $this->date_insc = $date_insc;

        return $this;
    }

    public function getLeCompte(): ?Compte
    {
        return $this->leCompte;
    }

    public function setLeCompte(?Compte $leCompte): static
    {
        $this->leCompte = $leCompte;

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
