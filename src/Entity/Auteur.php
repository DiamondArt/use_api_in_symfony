<?php

namespace App\Entity;

use App\Entity\Livre;
use App\Entity\Nationalite;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints AS Assert;

    /**
    * @author Melissa Kouadio  <melissa.kouadio@veone.net>
    *
    * @ORM\Entity()
    * @ORM\Table(name="`auteur`")
    * @ApiResource()
    */
    class Auteur
    {

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    * @Groups({"ListeAuteursFull","ListeAuteurs"})
    */
    private $id;

    /**
    * @ORM\Column(name="nom", type="string")
    * @Groups({"ListeGenreFull","ListeAuteursFull","ListeAuteurs"})
    * @Assert\NotBlank(message="Enregistrer une valeur valide")
    * @Assert\Length(min = 2, max = 30 , minMessage = "Entrer au minimun {{ limit }} caractères", maxMessage = "Valeur maximal d'insertion est de {{ limit }} caractères")
    * @var string
    */
    private $nom;

    /**
    * @ORM\Column(name="prenoms", type="string")
    * @Groups({"ListeGenreFull", "ListeAuteursFull", "ListeAuteurs"})
    * @Assert\NotBlank()
    * @Assert\Length(min = 2, max = 30 , minMessage = "Entrer au minimun {{ limit }} caractères", maxMessage = "Valeur maximal d'insertion est de {{ limit }} caractères")
    * @var string
    */
    private $prenoms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livre", mappedBy="auteur")
     * @Groups({"ListeAuteursFull"})
     */
    private $livres;

   /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nationalite", inversedBy="auteurs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ListeGenreFull","ListeAuteursFull","ListeAuteurs"})
     * @Assert\NotBlank(message="Enregistrer une valeur valide")
     * @Assert\Length(min = 2, max = 30 , minMessage = "Entrer au minimun {{ limit }} caractères", maxMessage = "Valeur maximal d'insertion est de {{ limit }} caractères")
     */
    private $nationalite;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): self
    {
        $this->prenoms = $prenoms;
        return $this;
    }

    public function getNationalite(): ? Nationalite
    {
        return $this->nationalite;
    }

    public function setNationalite(Nationalite $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->setAuteur($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            // set the owning side to null (unless already changed)
            if ($livre->getAuteur() === $this) {
                $livre->setAuteur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string)$this->nom . " " . $this->prenoms;
    }
}
