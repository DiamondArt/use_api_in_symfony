<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    /**
    * @author Melissa Kouadio  <melissa.kouadio@veone.net>
    *
    * @ORM\Entity()
    * @ORM\Table(name="`adherent`")
    */
    class Adherent
    {

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    *@ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(name="nom", type="string")
    * @var string
    */
    private $nom;

    /**
    * @ORM\Column(name="prenoms", type="string")
    * @var string
    */
    private $prenoms;

    /**
    * @ORM\Column(name="email", type="string")
    * @var string
    */
    private $email;

    /**
    * @ORM\Column(name="cp", type="integer")
    * @var int
    */
    private $cp;

    /**
    * @ORM\Column(name="tel", type="string")
    * @var string
    */
    private $tel;

    /**
    * @ORM\Column(name="adresse", type="string")
    * @var string
    */
    private $adresse;

    /**
    * @ORM\Column(name="ville", type="string")
    * @var string
    */
    private $ville;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;
        return $this;
    }
}
