<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LesRepository")
 */
class Les
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $beschrijving;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $looptijd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tarief;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    public function getLooptijd(): ?string
    {
        return $this->looptijd;
    }

    public function setLooptijd(string $looptijd): self
    {
        $this->looptijd = $looptijd;

        return $this;
    }

    public function getTarief(): ?string
    {
        return $this->tarief;
    }

    public function setTarief(string $tarief): self
    {
        $this->tarief = $tarief;

        return $this;
    }
}
