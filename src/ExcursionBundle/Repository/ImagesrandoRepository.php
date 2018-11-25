<?php
/**
 * Created by PhpStorm.
 * User: STA
 * Date: 25/11/2018
 * Time: 02:42
 */

namespace ExcursionBundle\Repository;


/**
 * ImagerandoRepository
 *
 */

class ImagesrandoRepository extends \Doctrine\ORM\EntityRepository
{
    public function myImagesFindByNewDate()
    {
        $query  = $this->getEntityManager()->createQuery(
            "SELECT I FROM ExcursionBundle:Imagesrando I WHERE I.randonne IN 
                  (SELECT R FROM ExcursionBundle:Randonne R WHERE R.daterando > :today)");
        $query->setParameter("today", new \DateTime());
        return $query->getResult();
    }
}