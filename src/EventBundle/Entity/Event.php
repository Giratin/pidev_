<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvent", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;
    /**
     * @var string
     *
     * @ORM\Column(name="dateEvent", type="string", length=30, nullable=false)
     */
    private $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuEvent", type="string", length=255, nullable=false)
     */
    private $lieuevent;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrePersonnes", type="integer", nullable=false)
     */
    private $nbrepersonnes;

    /**
     * @var integer
     *
     * @ORM\Column(name="capEvent", type="integer", nullable=false)
     */
    private $capevent;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvent", type="string", length=255, nullable=false)
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="ticketPrice", type="float", precision=10, scale=0, nullable=false)
     */
    private $ticketprice;
    /**
     * @var string
     *
     * @ORM\Column(name="eventImg", type="string", length=255, nullable=false)
     */
    private $eventImg;

    /**
     * @return int
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param int $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return string
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * @param string $dateevent
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;
    }

    /**
     * @return string
     */
    public function getLieuevent()
    {
        return $this->lieuevent;
    }

    /**
     * @param string $lieuevent
     */
    public function setLieuevent($lieuevent)
    {
        $this->lieuevent = $lieuevent;
    }

    /**
     * @return int
     */
    public function getNbrepersonnes()
    {
        return $this->nbrepersonnes;
    }

    /**
     * @param int $nbrepersonnes
     */
    public function setNbrepersonnes($nbrepersonnes)
    {
        $this->nbrepersonnes = $nbrepersonnes;
    }

    /**
     * @return int
     */
    public function getCapevent()
    {
        return $this->capevent;
    }

    /**
     * @param int $capevent
     */
    public function setCapevent($capevent)
    {
        $this->capevent = $capevent;
    }

    /**
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * @param string $nomevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;
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
     * @return float
     */
    public function getTicketprice()
    {
        return $this->ticketprice;
    }

    /**
     * @param float $ticketprice
     */
    public function setTicketprice($ticketprice)
    {
        $this->ticketprice = $ticketprice;
    }
    /**
     * @return string
     */
    public function getEventImg()
    {
        return $this->eventImg;
    }
    /**
     * @param string $eventImg
     */
    public function setEventImg($eventImg)
    {
        $this->eventImg = $eventImg;
    }


}
