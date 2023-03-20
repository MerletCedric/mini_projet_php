<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $codePostal;

    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="villeDepart")
     */
    private $departs_trajets;

    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="villeArrivee")
     */
    private $terminus_trajets;

    public function __construct()
    {
        $this->departs_trajets = new ArrayCollection();
        $this->terminus_trajets = new ArrayCollection();
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

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Trajet>
     */
    public function getDepartsTrajets(): Collection
    {
        return $this->departs_trajets;
    }

    public function addDepartsTrajet(Trajet $departsTrajet): self
    {
        if (!$this->departs_trajets->contains($departsTrajet)) {
            $this->departs_trajets[] = $departsTrajet;
            $departsTrajet->setVilleDepart($this);
        }

        return $this;
    }

    public function removeDepartsTrajet(Trajet $departsTrajet): self
    {
        if ($this->departs_trajets->removeElement($departsTrajet)) {
            // set the owning side to null (unless already changed)
            if ($departsTrajet->getVilleDepart() === $this) {
                $departsTrajet->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trajet>
     */
    public function getTerminusTrajets(): Collection
    {
        return $this->terminus_trajets;
    }

    public function addTerminusTrajet(Trajet $terminusTrajet): self
    {
        if (!$this->terminus_trajets->contains($terminusTrajet)) {
            $this->terminus_trajets[] = $terminusTrajet;
            $terminusTrajet->setVilleArrivee($this);
        }

        return $this;
    }

    public function removeTerminusTrajet(Trajet $terminusTrajet): self
    {
        if ($this->terminus_trajets->removeElement($terminusTrajet)) {
            // set the owning side to null (unless already changed)
            if ($terminusTrajet->getVilleArrivee() === $this) {
                $terminusTrajet->setVilleArrivee(null);
            }
        }

        return $this;
    }
}
