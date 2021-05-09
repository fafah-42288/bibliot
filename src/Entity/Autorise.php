<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AutoriseRepository")
 */
class Autorise
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
    private $dateDemande;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;
    /**
     * @ORM\Column(type="boolean")
     */
    private $autorisation;


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

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

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
    public function getAutorisation(): ?bool
    {
        return $this->autorisation;
    }

    public function setAutorisation(bool $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }
}
