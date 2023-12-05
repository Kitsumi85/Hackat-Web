<?php

namespace App\Entity;

use App\Repository\ConferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
class Conference extends Evenement
{


    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\ManyToOne]
    private ?Intervenant $UnIntervenant = null;


    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getUnIntervenant(): ?Intervenant
    {
        return $this->UnIntervenant;
    }

    public function setUnIntervenant(?Intervenant $UnIntervenant): static
    {
        $this->UnIntervenant = $UnIntervenant;

        return $this;
    }
}
