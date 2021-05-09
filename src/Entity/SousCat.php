<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SousCatRepository")
 */
class SousCat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numSousCat;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleSousCat;
    /**
    *@ORM\Column(type="integer", length=255)
     */
    private $idCat;


public function __toString(): ?string
{
    return $this->getLibelleSousCat().$this->getIdCat();
    // TODO: Implement __toString() method.
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSousCat(): ?int
    {
        return $this->numSousCat;
    }

    public function setNumSousCat(int $numSousCat): self
    {
        $this->numSousCat = $numSousCat;

        return $this;
    }

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function setIdCat(int $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }

    public function getLibelleSousCat(): ?string
    {
        return $this->libelleSousCat;
    }

    public function setLibelleSousCat(string $libelleSousCat): self
    {
        $this->libelleSousCat = $libelleSousCat;

        return $this;
    }
}
