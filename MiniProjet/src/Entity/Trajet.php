<?php

namespace App\Entity;

use App\Repository\TrajetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrajetRepository::class)
 */
class Trajet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="departs_trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="terminus_trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trajets_conducteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conducteur;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="trajets_passagers")
     */
    private $passagers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moedeleVoiture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlacesVoiture;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="trajets")
     */
    private $avis;

    public function __construct()
    {
        $this->passagers = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDepart(): ?Ville
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(?Ville $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getVilleArrivee(): ?Ville
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(?Ville $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getConducteur(): ?User
    {
        return $this->conducteur;
    }

    public function setConducteur(?User $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPassagers(): Collection
    {
        return $this->passagers;
    }

    public function addPassager(User $passager): self
    {
        if (!$this->passagers->contains($passager)) {
            $this->passagers[] = $passager;
        }

        return $this;
    }

    public function removePassager(User $passager): self
    {
        $this->passagers->removeElement($passager);

        return $this;
    }

    public function getMoedeleVoiture(): ?string
    {
        return $this->moedeleVoiture;
    }

    public function setMoedeleVoiture(string $moedeleVoiture): self
    {
        $this->moedeleVoiture = $moedeleVoiture;

        return $this;
    }

    public function getNbPlacesVoiture(): ?string
    {
        return $this->nbPlacesVoiture;
    }

    public function setNbPlacesVoiture(string $nbPlacesVoiture): self
    {
        $this->nbPlacesVoiture = $nbPlacesVoiture;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setTrajets($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getTrajets() === $this) {
                $avi->setTrajets(null);
            }
        }

        return $this;
    }
}
