<?php

namespace ExcursionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagesrando
 *
 * @ORM\Table(name="imagesrando")
 * @ORM\Entity(repositoryClass="ExcursionBundle\Repository\ImagesrandoRepository")
 */
class Imagesrando
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
     * @ORM\Column(name="imageUrl", type="string", length=255, nullable=false)
     */
    private $imageurl;

    /**
     * @ORM\ManyToOne(targetEntity="Randonne")
     * @ORM\JoinColumn(name="idRando", referencedColumnName="idRando")
     */
    private $randonne;



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
     * Set imageurl
     *
     * @param string $imageurl
     *
     * @return Imagesrando
     */
    public function setImageurl($imageurl)
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    /**
     * Get imageurl
     *
     * @return string
     */
    public function getImageurl()
    {
        return $this->imageurl;
    }

    /**
     * Set randonne
     *
     * @param \ExcursionBundle\Entity\Randonne $randonne
     *
     * @return Imagesrando
     */
    public function setRandonne(\ExcursionBundle\Entity\Randonne $randonne = null)
    {
        $this->randonne = $randonne;

        return $this;
    }

    /**
     * Get randonne
     *
     * @return \ExcursionBundle\Entity\Randonne
     */
    public function getRandonne()
    {
        return $this->randonne;
    }
}
