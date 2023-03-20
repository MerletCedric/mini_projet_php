<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="conducteur")
     */
    private $trajets_conducteur;

    /**
     * @ORM\ManyToMany(targetEntity=Trajet::class, mappedBy="passagers")
     */
    private $trajets_passagers;

    public function __construct()
    {
        $this->trajets_conducteur = new ArrayCollection();
        $this->trajets_passagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    /**
     * @return Collection<int, Trajet>
     */
    public function getTrajetsConducteur(): Collection
    {
        return $this->trajets_conducteur;
    }

    public function addTrajet(Trajet $trajetConducteur): self
    {
        if (!$this->trajets_conducteur->contains($trajetConducteur)) {
            $this->trajets_conducteur[] = $trajetConducteur;
            $trajetConducteur->setConducteur($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajetConducteur): self
    {
        if ($this->trajets_conducteur->removeElement($trajetConducteur)) {
            // set the owning side to null (unless already changed)
            if ($trajetConducteur->getConducteur() === $this) {
                $trajetConducteur->setConducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trajet>
     */
    public function getTrajetsPassagers(): Collection
    {
        return $this->trajets_passagers;
    }

    public function addTrajetsPassager(Trajet $trajetsPassager): self
    {
        if (!$this->trajets_passagers->contains($trajetsPassager)) {
            $this->trajets_passagers[] = $trajetsPassager;
            $trajetsPassager->addPassager($this);
        }

        return $this;
    }

    public function removeTrajetsPassager(Trajet $trajetsPassager): self
    {
        if ($this->trajets_passagers->removeElement($trajetsPassager)) {
            $trajetsPassager->removePassager($this);
        }

        return $this;
    }
}
