<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{


    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hackaton $id_hackathon = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $id_compte = null;

    #[ORM\Column]
    private ?bool $isFavori = null;

   

    public function getIdHackathon(): ?Hackaton
    {
        return $this->id_hackathon;
    }

    public function setIdHackathon(?Hackaton $id_hackathon): static
    {
        $this->id_hackathon = $id_hackathon;

        return $this;
    }

    public function getIdCompte(): ?Compte
    {
        return $this->id_compte;
    }

    public function setIdCompte(?Compte $id_compte): static
    {
        $this->id_compte = $id_compte;

        return $this;
    }

    public function isIsFavori(): ?bool
    {
        return $this->isFavori;
    }

    public function setIsFavori(bool $isFavori): static
    {
        $this->isFavori = $isFavori;

        return $this;
    }
}
