<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @author Melissa Kouadio  <melissa.kouadio@veone.net>
*
* @ORM\Entity()
* @ORM\Table(name="`regions`")
* @ORM\Entity(repositoryClass="App\Repository\RegionsRepository")
*/
class Regions
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
    * @ORM\Column(name="code", type="string", unique=true)
    * @var string
    */
    private $code;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}