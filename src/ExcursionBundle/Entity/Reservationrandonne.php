<?php

namespace ExcursionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationrandonne
 *
 * @ORM\Table(name="reservationrandonne")
 * @ORM\Entity(repositoryClass="ExcursionBundle\Repository\ReservationrandonneRepository")
 */
class Reservationrandonne
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
     * @var integer
     *
     * @ORM\Column(name="id_randonne", type="bigint", nullable=false)
     */
    private $idRandonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;



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
     * Set idRandonne
     *
     * @param integer $idRandonne
     *
     * @return Reservationrandonne
     */
    public function setIdRandonne($idRandonne)
    {
        $this->idRandonne = $idRandonne;

        return $this;
    }

    /**
     * Get idRandonne
     *
     * @return integer
     */
    public function getIdRandonne()
    {
        return $this->idRandonne;
    }

    /**
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Reservationrandonne
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return integer
     */
    public function getIdClient()
    {
        return $this->idClient;
    }
}
