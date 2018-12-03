<?php

namespace ExcursionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Randonne
 *
 * @ORM\Table(name="randonne", uniqueConstraints={@ORM\UniqueConstraint(name="idRandonne", columns={"idRando"})})
 * @ORM\Entity(repositoryClass="ExcursionBundle\Repository\ExcursionRepository")
 *
 */
class Randonne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRando", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrando;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreClient", type="integer", nullable=true)
     */
    private $nbreclient = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dateRando", type="string", length=30, nullable=false)
     */
    private $daterando;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=false)
     */
    private $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreBus", type="integer", nullable=false)
     */
    private $nbrebus = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="prixPersonne", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="programme", type="text", length=65535, nullable=false)
     */
    private $programme;

    /**
     * @var string
     *
     * @ORM\Column(name="googlemaps", type="text", length=65535, nullable=true)
     */
    private $googlemaps;

    /**
     *
     * @var string
     *
     * @Assert\Image()
     * @ORM\Column(name="imgUrl1", type="string", length=255, nullable=false)
     */
    private $imgurl1;

    /**
     * @var string
     *
     * @ORM\Column(name="imgUrl2", type="string", length=255, nullable=false)
     */
    private $imgurl2;

    /**
     * @var string
     *
     * @ORM\Column(name="imgUrl3", type="string", length=255, nullable=false)
     */
    private $imgurl3;



    /**
     * Get idrando
     *
     * @return integer
     */
    public function getIdrando()
    {
        return $this->idrando;
    }

    /**
     * Set capacite
     *
     * @param integer $capacite
     *
     * @return Randonne
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return integer
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set nbreclient
     *
     * @param integer $nbreclient
     *
     * @return Randonne
     */
    public function setNbreclient($nbreclient)
    {
        $this->nbreclient = $nbreclient;

        return $this;
    }

    /**
     * Get nbreclient
     *
     * @return integer
     */
    public function getNbreclient()
    {
        return $this->nbreclient;
    }

    /**
     * Set daterando
     *
     * @param string $daterando
     *
     * @return Randonne
     */
    public function setDaterando($daterando)
    {
        $this->daterando = $daterando;

        return $this;
    }

    /**
     * Get daterando
     *
     * @return string
     */
    public function getDaterando()
    {
        return $this->daterando;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Randonne
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set nbrebus
     *
     * @param integer $nbrebus
     *
     * @return Randonne
     */
    public function setNbrebus($nbrebus)
    {
        $this->nbrebus = $nbrebus;

        return $this;
    }

    /**
     * Get nbrebus
     *
     * @return integer
     */
    public function getNbrebus()
    {
        return $this->nbrebus;
    }

    /**
     * Set prixpersonne
     *
     * @param float $prixpersonne
     *
     * @return Randonne
     */
    public function setPrixpersonne($prixpersonne)
    {
        $this->prixpersonne = $prixpersonne;

        return $this;
    }

    /**
     * Get prixpersonne
     *
     * @return float
     */
    public function getPrixpersonne()
    {
        return $this->prixpersonne;
    }

    /**
     * Set programme
     *
     * @param string $programme
     *
     * @return Randonne
     */
    public function setProgramme($programme)
    {
        $this->programme = $programme;

        return $this;
    }

    /**
     * Get programme
     *
     * @return string
     */
    public function getProgramme()
    {
        return $this->programme;
    }

    /**
     * Set googlemaps
     *
     * @param string $googlemaps
     *
     * @return Randonne
     */
    public function setGooglemaps($googlemaps)
    {
        $this->googlemaps = $googlemaps;

        return $this;
    }

    /**
     * Get googlemaps
     *
     * @return string
     */
    public function getGooglemaps()
    {
        return $this->googlemaps;
    }

    /**
     * Set imgurl1
     *
     * @param string $imgurl1
     *
     * @return Randonne
     */
    public function setImgurl1($imgurl1)
    {
        $this->imgurl1 = $imgurl1;

        return $this;
    }

    /**
     * Get imgurl1
     *
     * @return string
     */
    public function getImgurl1()
    {
        return $this->imgurl1;
    }

    /**
     * Set imgurl2
     *
     * @param string $imgurl2
     *
     * @return Randonne
     */
    public function setImgurl2($imgurl2)
    {
        $this->imgurl2 = $imgurl2;

        return $this;
    }

    /**
     * Get imgurl2
     *
     * @return string
     */
    public function getImgurl2()
    {
        return $this->imgurl2;
    }

    /**
     * Set imgurl3
     *
     * @param string $imgurl3
     *
     * @return Randonne
     */
    public function setImgurl3($imgurl3)
    {
        $this->imgurl3 = $imgurl3;

        return $this;
    }

    /**
     * Get imgurl3
     *
     * @return string
     */
    public function getImgurl3()
    {
        return $this->imgurl3;
    }
}
