<?php

namespace ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activity
 *
 * @ORM\Table(name="activity", indexes={@ORM\Index(name="ifbk_type", columns={"typeActivite"})})
 * @ORM\Entity(repositoryClass="ActivityBundle\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @var string
     *
     * @ORM\Column(name="adresseActivite", type="string", length=255, nullable=false)
     */
    private $adresseactivite;

    /**
     * @var integer
     *
     * @ORM\Column(name="idActivite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idactivite;

    /**
     * @var string
     *
     * @ORM\Column(name="dateActivite", type="string", length=255, nullable=true)
     */
    private $dateactivite;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imagActivity", type="string", length=255, nullable=false)
     */
    private $imagactivity;

    /**
     * @Assert\File(maxSize="5000k")
     */
    public $file;

    /**
     * @ORM\ManyToOne(targetEntity="ActivityType")
     * @ORM\JoinColumn(name="typeActivite", referencedColumnName="id_type")
     * })
     */
    private $typeactivite;

    /**
     * @return string
     */
    public function getAdresseactivite()
    {
        return $this->adresseactivite;
    }

    /**
     * @param string $adresseactivite
     */
    public function setAdresseactivite($adresseactivite)
    {
        $this->adresseactivite = $adresseactivite;
    }

    /**
     * @return int
     */
    public function getIdactivite()
    {
        return $this->idactivite;
    }

    /**
     * @param int $idactivite
     */
    public function setIdactivite($idactivite)
    {
        $this->idactivite = $idactivite;
    }

    /**
     * @return string
     */
    public function getDateactivite()
    {
        return $this->dateactivite;
    }

    /**
     * @param string $dateactivite
     */
    public function setDateactivite($dateactivite)
    {
        $this->dateactivite = $dateactivite;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImagactivity()
    {
        return $this->imagactivity;
    }

    /**
     * @param string $imagactivity
     */
    public function setImagactivity($imagactivity)
    {
        $this->imagactivity = $imagactivity;
    }

    /**
     * @return mixed
     */
    public function getTypeactivite()
    {
        return $this->typeactivite;
    }

    /**
     * @param mixed $typeactivite
     */
    public function setTypeactivite($typeactivite)
    {
        $this->typeactivite = $typeactivite;
    }
    public function getWebPath()
    {
        return null=== $this->imagactivity ? null : $this->getUploadDir.'/'.$this->imagactivity;
    }
    protected  function getUploadRootDir()
    {
        return __DIR__.'/../../../web/uploads'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        return 'uploadsuploads';
    }
    public function UploadActivityPicture(){
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->imagactivity=$this->file->getClientOriginalName();
        $this->file=null;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


}

