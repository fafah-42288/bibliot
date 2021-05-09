<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LireRepository")
 */
class Lire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $titreLivre;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $cheminLivre;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLire;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreLivre(): ?string
    {
        return $this->titreLivre;
    }

    public function setTitreLivre(string $titreLivre): self
    {
        $this->titreLivre = $titreLivre;

        return $this;
    }
    public function getCheminLivre(): ?string
    {
        return $this->cheminLivre;
    }

    public function setCheminLivre(string $cheminLivre): self
    {
        $this->cheminLivre = $cheminLivre;

        return $this;
    }

    public function getDateLire(): ?\DateTimeInterface
    {
        return $this->dateLire;
    }

    public function setDateLire(\DateTimeInterface $dateLire): self
    {
        $this->dateLire = $dateLire;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
