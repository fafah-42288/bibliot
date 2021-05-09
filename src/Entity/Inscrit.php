<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscritRepository")
 */
class Inscrit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $sinoda;
    /**
     * @ORM\Column(type="string", length=180)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=180)
     */
    private $fonction;
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getSinoda(): ?string
    {
        return $this->sinoda;
    }

    /**
     * @param mixed $username
     */
    public function setSinoda(string $sinoda): self
    {
        $this->sinoda = $sinoda;
        return $this;
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
    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    /**
     * @param mixed $username
     */
    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;
        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

}
