<?php

namespace App\Entity;
use Doctrine\ORM\EntityManager;use Doctrine\ORM\Mapping as ORM;
use mysql_xdevapi\Exception;
use mysql_xdevapi\TableUpdate;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassiqueRepository")
 * @Vich\Uploadable()
 */
class Classique
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
    private $numIvent;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreLiv;

    /**
     *@ORM\Column(type="integer")
     */
    private $idCat;

    /**
     *@ORM\Column(type="integer")
     */
    private $idSousCat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteurLiv;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuEditLiv;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEditLiv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isbnLiv;


    /**
     * @ORM\Column(type="string",length=255)
     */
    private $cheminLiv;
    /**
     * @Vich\UploadableField(mapping="classique_file", fileNameProperty="cheminLiv")
     * @var File
     */
    private $livFile;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $cheminCouv;
    /**
     * @Vich\UploadableField(mapping="classique_couv", fileNameProperty="cheminCouv")
     * @var File
     */
    private $couvFile;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updatedAt;
    public function __toString(): ?string
    {
        return $this->getIdSousCat().$this->getIdCat();
        // TODO: Implement __toString() method.
    }
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getLivFile()
    {
        return $this->livFile;
    }

    /**
     * @param mixed $livFile
     * @throws \Exception
     */
    public function setLivFile(File $cheminLiv = null)
    {
        $this->livFile = $cheminLiv;
        if ($cheminLiv) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function getCouvFile()
    {
        return $this->couvFile;
    }

    /**
     * @param mixed $livFile
     * @throws \Exception
     */
    public function setCouvFile(File $cheminCouv = null)
    {
        $this->couvFile = $cheminCouv;
        if ($cheminCouv) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumIvent(): ?int
    {
        return $this->numIvent;
    }

    public function setNumIvent(int $numIvent): self
    {
        $this->numIvent = $numIvent;
        return $this;
    }

    public function getTitreLiv(): ?string
    {
        return $this->titreLiv;
    }

    public function setTitreLiv(string $titreLiv): self
    {
        $this->titreLiv = $titreLiv;

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

    public function getIdSousCat(): ?int
    {
        return $this->idSousCat;
    }

    public function setIdSousCat(int $idSousCat): self
    {
        $this->idSousCat = $idSousCat;

        return $this;
    }
    public function getAuteurLiv(): ?string
    {
        return $this->auteurLiv;
    }

    public function setAuteurLiv(string $auteurLiv): self
    {
        $this->auteurLiv = $auteurLiv;

        return $this;
    }


    public function getLieuEditLiv(): ?string
    {
        return $this->lieuEditLiv;
    }

    public function setLieuEditLiv(string $lieuEditLiv): self
    {
        $this->lieuEditLiv = $lieuEditLiv;

        return $this;
    }

    public function getDateEditLiv(): ?\DateTimeInterface
    {
        return $this->dateEditLiv;
    }

    public function setDateEditLiv(\DateTimeInterface $dateEditLiv): self
    {
        $this->dateEditLiv = $dateEditLiv;

        return $this;
    }

    public function getIsbnLiv(): ?string
    {
        return $this->isbnLiv;
    }

    public function setIsbnLiv(string $isbnLiv): self
    {
        $this->isbnLiv = $isbnLiv;

        return $this;
    }


    public function getCheminLiv(): ?string
    {
        return $this->cheminLiv;
    }

    public function setCheminLiv(?string $cheminLiv): self
    {
        $this->cheminLiv = $cheminLiv;

        return $this;
    }
    public function getCheminCouv(): ?string
    {
        return $this->cheminCouv;
    }

    public function setCheminCouv(?string $cheminCouv): self
    {
        $this->cheminCouv = $cheminCouv;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
