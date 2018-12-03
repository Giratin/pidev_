<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idHotel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhotel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseHotel", type="string", length=20, nullable=false)
     */
    private $adressehotel;

    /**
     * @var string
     *
     * @ORM\Column(name="nameHotel", type="string", length=10, nullable=false)
     */
    private $namehotel;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeHotel", type="integer", nullable=false)
     */
    private $typehotel;

    /**
     * @var string
     *
     * @ORM\Column(name="imgHotel", type="string", length=255, nullable=false)
     */
    private $imghotel;
    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_chambre", type="integer", nullable=false)
     */

    private $nbreChambre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_de_chambre_despo", type="integer", nullable=false)
     */
    private $nbreDeChambreDespo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_indiv", type="integer", nullable=true)
     */
    private $prixIndiv = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_double", type="integer", nullable=true)
     */
    private $prixDouble = '0';

    /**
     * Set idhotel
     *
     * @param integer $id
     *
     * @return Hotel
     */
    public function setIdhotel($id)
    {
        $this->idhotel = $id;

        return $this;
    }

    /**
     * Get idhotel
     *
     * @return integer
     */
    public function getIdhotel()
    {
        return $this->idhotel;
    }

    /**
     * Set adressehotel
     *
     * @param string $adressehotel
     *
     * @return Hotel
     */
    public function setAdressehotel($adressehotel)
    {
        $this->adressehotel = $adressehotel;

        return $this;
    }

    /**
     * Get adressehotel
     *
     * @return string
     */
    public function getAdressehotel()
    {
        return $this->adressehotel;
    }

    /**
     * Set namehotel
     *
     * @param string $namehotel
     *
     * @return Hotel
     */
    public function setNamehotel($namehotel)
    {
        $this->namehotel = $namehotel;

        return $this;
    }

    /**
     * Get namehotel
     *
     * @return string
     */
    public function getNamehotel()
    {
        return $this->namehotel;
    }

    /**
     * Set typehotel
     *
     * @param integer $typehotel
     *
     * @return Hotel
     */
    public function setTypehotel($typehotel)
    {
        $this->typehotel = $typehotel;

        return $this;
    }

    /**
     * Get typehotel
     *
     * @return integer
     */
    public function getTypehotel()
    {
        return $this->typehotel;
    }

    /**
     * Set nbreChambre
     *
     * @param integer $nbreChambre
     *
     * @return Hotel
     */
    public function setNbreChambre($nbreChambre)
    {
        $this->nbreChambre = $nbreChambre;

        return $this;
    }

    /**
     * Get nbreChambre
     *
     * @return integer
     */
    public function getNbreChambre()
    {
        return $this->nbreChambre;
    }

    /**
     * Set nbreDeChambreDespo
     *
     * @param integer $nbreDeChambreDespo
     *
     * @return Hotel
     */
    public function setNbreDeChambreDespo($nbreDeChambreDespo)
    {
        $this->nbreDeChambreDespo = $nbreDeChambreDespo;

        return $this;
    }

    /**
     * Get nbreDeChambreDespo
     *
     * @return integer
     */
    public function getNbreDeChambreDespo()
    {
        return $this->nbreDeChambreDespo;
    }

    /**
     * Set prixIndiv
     *
     * @param integer $prixIndiv
     *
     * @return Hotel
     */
    public function setPrixIndiv($prixIndiv)
    {
        $this->prixIndiv = $prixIndiv;

        return $this;
    }

    /**
     * Get prixIndiv
     *
     * @return integer
     */
    public function getPrixIndiv()
    {
        return $this->prixIndiv;
    }

    /**
     * Set prixDouble
     *
     * @param integer $prixDouble
     *
     * @return Hotel
     */
    public function setPrixDouble($prixDouble)
    {
        $this->prixDouble = $prixDouble;

        return $this;
    }

    /**
     * Get prixDouble
     *
     * @return integer
     */
    public function getPrixDouble()
    {
        return $this->prixDouble;
    }

    /**
     * Set imghotel
     *
     * @param string $imghotel
     *
     * @return Hotel
     */
    public function setImghotel($imghotel)
    {
        $this->imghotel = $imghotel;

        return $this;
    }

    /**
     * Get imghotel
     *
     * @return string
     */
    public function getImghotel()
    {
        return $this->imghotel;
    }
}
