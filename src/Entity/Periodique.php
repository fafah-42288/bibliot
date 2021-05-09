<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PeriodiqueRepository")
 * @Vich\Uploadable()
 */
class Periodique
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
    private $NumPer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TitrePer;

    /**
     * @ORM\Column(type="integer")
     */
    private $idTheme;

    /**
     * @ORM\Column(type="integer")
     */
    private $idVol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AuteurPer;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPagePer;
    /**
     * @ORM\Column(type="integer")
     */
    private $NumEditPer;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $dateEntrePer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuEditPer;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $dateEditPer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $issnPer;


    /**
     * @Vich\UploadableField(mapping="periodique_file", fileNameProperty="cheminPer")
     * @var File
     */
    private $perFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cheminPer;
    /**
     * @Vich\UploadableField(mapping="periodique_couvPer", fileNameProperty="cheminCouvPer")
     * @var File
     */
    private $couvPerFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cheminCouvPer;
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updatedAt;
    /**
     * @return mixed
     */
    public function getPerFile()
    {
        return $this->perFile;
    }
    public function getCouvPerFile()
    {
        return $this->couvPerFile;
    }
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->numEditPer = 0;
    }
    /**
     * @param mixed $perFile
     * @throws \Exception
     */
    public function setPerFile(File $cheminPer = null)
    {
        $this->perFile = $cheminPer;
        if ($cheminPer) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function setCouvPerFile(File $cheminCouvPer = null)
    {
        $this->couvPerFile = $cheminCouvPer;
        if ($cheminCouvPer) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPer(): ?int
    {
        return $this->NumPer;
    }

    public function setNumPer(int $NumPer): self
    {
        $this->NumPer = $NumPer;

        return $this;
    }

    public function getTitrePer(): ?string
    {
        return $this->TitrePer;
    }

    public function setTitrePer(string $TitrePer): self
    {
        $this->TitrePer = $TitrePer;

        return $this;
    }

    public function getIdTheme(): ?int
    {
        return $this->idTheme;
    }

    public function setIdTheme(?int $idTheme): self
    {
        $this->idTheme = $idTheme;

        return $this;
    }

    public function getIdVol(): ?int
    {
        return $this->idVol;
    }

    public function setIdVol(?int $idVol): self
    {
        $this->idVol = $idVol;

        return $this;
    }

    public function getNumEditPer(): ?int
    {
        return $this->NumEditPer;
    }

    public function setNumEditPer(?int $NumEditPer): self
    {
        $this->NumEditPer = $NumEditPer;

        return $this;
    }

    public function getAuteurPer(): ?string
    {
        return $this->AuteurPer;
    }

    public function setAuteurPer(string $AuteurPer): self
    {
        $this->AuteurPer = $AuteurPer;

        return $this;
    }

    public function getNbPagePer(): ?int
    {
        return $this->nbPagePer;
    }

    public function setNbPagePer(int $nbPagePer): self
    {
        $this->nbPagePer = $nbPagePer;

        return $this;
    }

    public function getDateEntrePer(): ?\DateTimeInterface
    {
        return $this->dateEntrePer;
    }

    public function setDateEntrePer(\DateTimeInterface $dateEntrePer): self
    {
        $this->dateEntrePer = $dateEntrePer;

        return $this;
    }

    public function getLieuEditPer(): ?string
    {
        return $this->lieuEditPer;
    }

    public function setLieuEditPer(string $lieuEditPer): self
    {
        $this->lieuEditPer = $lieuEditPer;

        return $this;
    }

    public function getDateEditPer(): ?\DateTimeInterface
    {
        return $this->dateEditPer;
    }

    public function setDateEditPer(\DateTimeInterface $dateEditPer): self
    {
        $this->dateEditPer = $dateEditPer;

        return $this;
    }

    public function getIssnPer(): ?string
    {
        return $this->issnPer;
    }

    public function setIssnPer(string $issnPer): self
    {
        $this->issnPer = $issnPer;

        return $this;
    }

    public function getCoutPer(): ?int
    {
        return $this->coutPer;
    }

    public function setCoutPer(int $coutPer): self
    {
        $this->coutPer = $coutPer;

        return $this;
    }

    public function getLargPer(): ?int
    {
        return $this->largPer;
    }

    public function setLargPer(int $largPer): self
    {
        $this->largPer = $largPer;

        return $this;
    }

    public function getLongPer(): ?int
    {
        return $this->longPer;
    }

    public function setLongPer(int $longPer): self
    {
        $this->longPer = $longPer;

        return $this;
    }

    public function getRemPer(): ?string
    {
        return $this->remPer;
    }

    public function setRemPer(string $remPer): self
    {
        $this->remPer = $remPer;

        return $this;
    }

    public function getCheminPer(): ?string
    {
        return $this->cheminPer;
    }

    public function setCheminPer(string $cheminPer): self
    {
        $this->cheminPer = $cheminPer;

        return $this;
    }
    public function getCheminCouvPer(): ?string
    {
        return $this->cheminCouvPer;
    }

    public function setCheminCouvPer(string $cheminCouvPer): self
    {
        $this->cheminCouvPer = $cheminCouvPer;

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
