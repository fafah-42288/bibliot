<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PerikopaRepository")
 * @Vich\Uploadable()
 */
class Perikopa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="\Date")
     * @var DateTime
     */
    private $date;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $cheminPer;
    /**
     * @Vich\UploadableField(mapping="perikopa", fileNameProperty="cheminPer")
     * @var File
     */
    private $image;
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $livFile
     * @throws \Exception
     */
    public function setImage(File $image = null)
    {
        $this->image = $image;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;

    }
    public function getCheminPer(): ?string
    {
        return $this->cheminPer;
    }

    public function setCheminPer(?string $cheminPer): self
    {
        $this->cheminPer = $cheminPer;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
}
