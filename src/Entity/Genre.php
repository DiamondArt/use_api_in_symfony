<?php

namespace App\Entity;

use App\Entity\Livre;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints AS Assert;

    /**
    * @author Melissa Kouadio  <melissa.kouadio@veone.net>
    *
    * @ORM\Entity()
    * @ORM\Table(name="`genre`")
    * @ApiResource()
    */
    class Genre
    {

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    * @Groups({"listeGenres","ListeGenreFull"})
    */
    private $id;

    /**
    * @ORM\Column(name="libelle", type="string")
    * @Groups({"listeGenres","ListeGenreFull","ListeAuteursFull"})
    * @Assert\NotBlank()
    * @Assert\Length(min=2, max=50, minMessage ="libelle doit contenir au minimun {{ limit }} caractère", maxMessage = " le libelle doit contenir au plus {{ limit }} caractère")
    * @var string
    */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livre", mappedBy="genre")
     * @Groups({"ListeGenreFull"})
     */
    private $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
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
            if ($livre->getGenre() === $this) {
                $livre->setGenre(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string)$this->libelle;
    }
}
