<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chambre
 *
 * @ORM\Table(name="chambre")
 * @ORM\Entity
 */
class Chambre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typeChambre", type="string", length=30, nullable=false)
     */
    private $typechambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="numChambre", type="integer", nullable=false)
     */
    private $numchambre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispo", type="boolean", nullable=false)
     */
    private $dispo = '1';

    /**
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumn(name="idHotel", referencedColumnName="idHotel")
     */
    private $hotel;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typechambre
     *
     * @param string $typechambre
     *
     * @return Chambre
     */
    public function setTypechambre($typechambre)
    {
        $this->typechambre = $typechambre;

        return $this;
    }

    /**
     * Get typechambre
     *
     * @return string
     */
    public function getTypechambre()
    {
        return $this->typechambre;
    }

    /**
     * Set numchambre
     *
     * @param integer $numchambre
     *
     * @return Chambre
     */
    public function setNumchambre($numchambre)
    {
        $this->numchambre = $numchambre;

        return $this;
    }

    /**
     * Get numchambre
     *
     * @return integer
     */
    public function getNumchambre()
    {
        return $this->numchambre;
    }

    /**
     * Set dispo
     *
     * @param boolean $dispo
     *
     * @return Chambre
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * Get dispo
     *
     * @return boolean
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Set hotel
     *
     * @param \HotelBundle\Entity\Hotel $hotel
     *
     * @return Chambre
     */
    public function sethotel(\HotelBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \HotelBundle\Entity\Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
