<?php

namespace VoyageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity(repositoryClass="VoyageBundle\Repository\VoyageRepository")
 */
class Voyage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idVoyage", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="destinationVoyage", type="string", length=255, nullable=true)
     */
    private $destinationvoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="dateVoyageAller", type="string", length=255, nullable=true)
     */
    private $datevoyagealler;

    /**
     * @var string
     *
     * @ORM\Column(name="hdepartVoyageAller", type="string", length=255, nullable=true)
     */
    private $hdepartvoyagealler;

    /**
     * @var string
     *
     * @ORM\Column(name="harriveeVoyageAller", type="string", length=255, nullable=true)
     */
    private $harriveevoyagealler;

    /**
     * @var string
     *
     * @ORM\Column(name="departVoyage", type="string", length=255, nullable=true)
     */
    private $departvoyage;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place_dispo", type="integer", nullable=true)
     */
    private $nbPlaceDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="dateVoyageRetour", type="string", length=255, nullable=true)
     */
    private $datevoyageretour;

    /**
     * @var string
     *
     * @ORM\Column(name="hdepartVoyageRetour", type="string", length=255, nullable=true)
     */
    private $hdepartvoyageretour;

    /**
     * @var string
     *
     * @ORM\Column(name="harriveeVoyageRetour", type="string", length=255, nullable=true)
     */
    private $harriveevoyageretour;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="num", type="integer", nullable=false)
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="compagnie", type="string", length=20, nullable=false)
     */
    private $compagnie;


    /**
     * @var string
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     *
     */
    private $image;
    /**
     * Get idvoyage
     *
     * @return integer
     */
    public function getIdvoyage()
    {
        return $this->idvoyage;
    }

    /**
     * Set destinationvoyage
     *
     * @param string $destinationvoyage
     *
     * @return Voyage
     */
    public function setDestinationvoyage($destinationvoyage)
    {
        $this->destinationvoyage = $destinationvoyage;

        return $this;
    }

    /**
     * Get destinationvoyage
     *
     * @return string
     */
    public function getDestinationvoyage()
    {
        return $this->destinationvoyage;
    }

    /**
     * Set datevoyagealler
     *
     * @param string $datevoyagealler
     *
     * @return Voyage
     */
    public function setDatevoyagealler($datevoyagealler)
    {
        $this->datevoyagealler = $datevoyagealler;

        return $this;
    }

    /**
     * Get datevoyagealler
     *
     * @return string
     */
    public function getDatevoyagealler()
    {
        return $this->datevoyagealler;
    }

    /**
     * Set hdepartvoyagealler
     *
     * @param string $hdepartvoyagealler
     *
     * @return Voyage
     */
    public function setHdepartvoyagealler($hdepartvoyagealler)
    {
        $this->hdepartvoyagealler = $hdepartvoyagealler;

        return $this;
    }

    /**
     * Get hdepartvoyagealler
     *
     * @return string
     */
    public function getHdepartvoyagealler()
    {
        return $this->hdepartvoyagealler;
    }

    /**
     * Set harriveevoyagealler
     *
     * @param string $harriveevoyagealler
     *
     * @return Voyage
     */
    public function setHarriveevoyagealler($harriveevoyagealler)
    {
        $this->harriveevoyagealler = $harriveevoyagealler;

        return $this;
    }

    /**
     * Get harriveevoyagealler
     *
     * @return string
     */
    public function getHarriveevoyagealler()
    {
        return $this->harriveevoyagealler;
    }

    /**
     * Set departvoyage
     *
     * @param string $departvoyage
     *
     * @return Voyage
     */
    public function setDepartvoyage($departvoyage)
    {
        $this->departvoyage = $departvoyage;

        return $this;
    }

    /**
     * Get departvoyage
     *
     * @return string
     */
    public function getDepartvoyage()
    {
        return $this->departvoyage;
    }

    /**
     * Set nbPlaceDispo
     *
     * @param integer $nbPlaceDispo
     *
     * @return Voyage
     */
    public function setNbPlaceDispo($nbPlaceDispo)
    {
        $this->nbPlaceDispo = $nbPlaceDispo;

        return $this;
    }

    /**
     * Get nbPlaceDispo
     *
     * @return integer
     */
    public function getNbPlaceDispo()
    {
        return $this->nbPlaceDispo;
    }

    /**
     * Set datevoyageretour
     *
     * @param string $datevoyageretour
     *
     * @return Voyage
     */
    public function setDatevoyageretour($datevoyageretour)
    {
        $this->datevoyageretour = $datevoyageretour;

        return $this;
    }

    /**
     * Get datevoyageretour
     *
     * @return string
     */
    public function getDatevoyageretour()
    {
        return $this->datevoyageretour;
    }

    /**
     * Set hdepartvoyageretour
     *
     * @param string $hdepartvoyageretour
     *
     * @return Voyage
     */
    public function setHdepartvoyageretour($hdepartvoyageretour)
    {
        $this->hdepartvoyageretour = $hdepartvoyageretour;

        return $this;
    }

    /**
     * Get hdepartvoyageretour
     *
     * @return string
     */
    public function getHdepartvoyageretour()
    {
        return $this->hdepartvoyageretour;
    }

    /**
     * Set harriveevoyageretour
     *
     * @param string $harriveevoyageretour
     *
     * @return Voyage
     */
    public function setHarriveevoyageretour($harriveevoyageretour)
    {
        $this->harriveevoyageretour = $harriveevoyageretour;

        return $this;
    }

    /**
     * Get harriveevoyageretour
     *
     * @return string
     */
    public function getHarriveevoyageretour()
    {
        return $this->harriveevoyageretour;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Voyage
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set num
     *
     * @param integer $num
     *
     * @return Voyage
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set compagnie
     *
     * @param string $compagnie
     *
     * @return Voyage
     */
    public function setCompagnie($compagnie)
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    /**
     * Get compagnie
     *
     * @return string
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

}
