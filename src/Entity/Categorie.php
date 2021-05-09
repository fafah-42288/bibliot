<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $numCat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleCat;
   public function __toString(): ?string
   {
       return $this->getLibelleCat().$this->getId();
       // TODO: Implement __toString() method.
   }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCat(): ?int
    {
        return $this->numCat;
    }

    public function setNumCat(int $numCat): self
    {
        $this->numCat = $numCat;

        return $this;
    }

    public function getLibelleCat(): ?string
    {
        return $this->libelleCat;
    }

    public function setLibelleCat(string $libelleCat): self
    {
        $this->libelleCat = $libelleCat;

        return $this;
    }
}
