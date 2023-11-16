<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, inversedBy: 'LesPersonnes')]
    private Collection $LesAteliers;

    public function __construct()
    {
        $this->LesAteliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getLesAteliers(): Collection
    {
        return $this->LesAteliers;
    }

    public function addLesAtelier(Atelier $lesAtelier): static
    {
        if (!$this->LesAteliers->contains($lesAtelier)) {
            $this->LesAteliers->add($lesAtelier);
        }

        return $this;
    }

    public function removeLesAtelier(Atelier $lesAtelier): static
    {
        $this->LesAteliers->removeElement($lesAtelier);

        return $this;
    }
}
