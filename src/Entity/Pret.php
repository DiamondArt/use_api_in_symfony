<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    /**
    * @author Melissa Kouadio  <melissa.kouadio@veone.net>
    *
    * @ORM\Entity()
    * @ORM\Table(name="`pret`")
    */
    class Pret
    {

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    *@ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(name="date_pret", type="date")
    * @var datetime
    */
    private $datePret;

    /**
    * @ORM\Column(name="date_retour_Prevu", type="date")
    * @var datetime
    */
    private $dateRetourPrevu;

    /**
    * @ORM\Column(name="date_retour_reel", type="date")
    * @var date
    */
    private $dateRetourReel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatepret(): ?date
    {
        return $this->datePret;
    }

    public function setDatePret(date $datePret): self
    {
        $this->datePret = $datePret;
        return $this;
    }

    public function getDateRetourPrevu(): ?date
    {
        return $this->dateRetourPrevu;
    }

    public function setDateRetourPrevu(date $dateRetourPrevu): self
    {
        $this->dateRetourPrevu = $dateRetourPrevu;
        return $this;
    }

    public function getDateRetourReel(): ?date
    {
        return $this->dateRetourReel;
    }

    public function setDateRetourReel(date $dateRetourReel): self
    {
        $this->dateRetourReel = $dateRetourReel;
        return $this;
    }
}
