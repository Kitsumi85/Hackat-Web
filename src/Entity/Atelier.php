<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier extends Evenement
{


    #[ORM\Column]
    private ?int $nbPlaces = null;

    #[ORM\ManyToMany(targetEntity: Personne::class, mappedBy: 'LesAteliers')]
    private Collection $LesPersonnes;

    public function __construct()
    {
        $this->LesPersonnes = new ArrayCollection();
    }


    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getLesPersonnes(): Collection
    {
        return $this->LesPersonnes;
    }

    public function addLesPersonne(Personne $lesPersonne): static
    {
        if (!$this->LesPersonnes->contains($lesPersonne)) {
            $this->LesPersonnes->add($lesPersonne);
            $lesPersonne->addLesAtelier($this);
        }

        return $this;
    }

    public function removeLesPersonne(Personne $lesPersonne): static
    {
        if ($this->LesPersonnes->removeElement($lesPersonne)) {
            $lesPersonne->removeLesAtelier($this);
        }

        return $this;
    }
}
