<?php

namespace VoyageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationvoyage
 *
 * @ORM\Table(name="reservationvoyage", indexes={@ORM\Index(name="IDX_F6DAB56E5C8C21CF", columns={"idVoyage"})})
 * @ORM\Entity(repositoryClass="VoyageBundle\Repository\ReservationvoyageRepository")
 */
class Reservationvoyage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumn(name="idVoyage",referencedColumnName="idVoyage")
     */
    private $voyage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_place_reserv", type="integer", nullable=true)
     */
    private $nbrePlaceReserv;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=20, nullable=true)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;



    /**
     * Get idreservation
     *
     * @return integer
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * Set idvoyage
     *
     * @param integer $idvoyage
     *
     * @return Reservationvoyage
     */
    public function setIdvoyage($idvoyage)
    {
        $this->idvoyage = $idvoyage;

        return $this;
    }

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
     * Set id
     *
     * @param integer $id
     *
     * @return Reservationvoyage
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set nbrePlaceReserv
     *
     * @param integer $nbrePlaceReserv
     *
     * @return Reservationvoyage
     */
    public function setNbrePlaceReserv($nbrePlaceReserv)
    {
        $this->nbrePlaceReserv = $nbrePlaceReserv;

        return $this;
    }

    /**
     * Get nbrePlaceReserv
     *
     * @return integer
     */
    public function getNbrePlaceReserv()
    {
        return $this->nbrePlaceReserv;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Reservationvoyage
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Reservationvoyage
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Reservationvoyage
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Reservationvoyage
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
     * Set voyage
     *
     * @param \VoyageBundle\Entity\Voyage $voyage
     *
     * @return Reservationvoyage
     */
    public function setVoyage(\VoyageBundle\Entity\Voyage $voyage = null)
    {
        $this->voyage = $voyage;

        return $this;
    }

    /**
     * Get voyage
     *
     * @return \VoyageBundle\Entity\Voyage
     */
    public function getVoyage()
    {
        return $this->voyage;
    }
}
