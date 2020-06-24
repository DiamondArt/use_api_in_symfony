<?php

namespace App\Entity;

use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Editeur;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

    /**
    * @author Melissa Kouadio  <melissa.kouadio@veone.net>
    *
    * @ORM\Entity()
    * @ORM\Table(name="`livre`")
    */
    class Livre
    {

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(name="isbn", type="string")
    * @Groups({"ListeGenreFull", "ListeAuteursFull"})
    * @var string
    */
    private $isbn;

    /**
    * @ORM\Column(name="titre", type="string")
    * @Groups({"ListeGenreFull", "ListeAuteursFull"})
    * @var string
    */
    private $titre;

    /**
    * @ORM\Column(name="prix", type="float")
    * @Groups({"ListeGenreFull", "ListeAuteursFull"})
    * @var float
    */
    private $prix;

    /**
    * @ORM\Column(name="annee", type="integer", nullable=true)
    * @Groups({"ListeGenreFull", "ListeAuteursFull"})
    * @var int
    */
    private $annee;

    /**
    * @ORM\Column(name="langue", type="string")
    * @Groups({"ListeGenreFull", "ListeAuteursFull"})
    * @var string
    */
    private $langue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Auteur", inversedBy="livres")
     * @ORM\JoinColumn(name="auteur", referencedColumnName="id")
     * @Groups({"ListeGenreFull"})
     * @var Auteur
    */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editeur", inversedBy="livres")
     * @ORM\JoinColumn(name="editeur", referencedColumnName="id")
     * @Groups({"ListeGenreFull", "ListeAuteursFull"})
     * @var Editeur
    */
    private $editeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="livres")
     * @ORM\JoinColumn(name="genre", referencedColumnName="id")
     * @Groups({"ListeAuteursFull"})
     * @var Genre
    */
    private $genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->time = $titre;
        return $this;
    }

        public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;
        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;
        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(Auteur $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(Editeur $editeur): self
    {
        $this->editeur = $editeur;
        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    public function __toString()
    {
        return (string)$this->titre . " " . $this->prix;
    }
}
