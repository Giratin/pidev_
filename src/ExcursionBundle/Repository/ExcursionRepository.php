<?php
/**
 * Created by PhpStorm.
 * User: STA
 * Date: 25/11/2018
 * Time: 04:56
 */

namespace ExcursionBundle\Repository;

/**
 * ExcursionRepository
 *
 */

class ExcursionRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFindByNewDate()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R FROM ExcursionBundle:Randonne R WHERE R.daterando > :today")
                ->setParameter("today", new \DateTime());
        return $query->getResult();
    }


    public function myfindByOldDate()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R FROM ExcursionBundle:Randonne R WHERE R.daterando < :today")
                ->setParameter("today", new \DateTime());
        return $query->getResult();
    }

    public function countNewExcursion()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(R.idrando) as nm FROM ExcursionBundle:Randonne R WHERE R.daterando > :today")
            ->setParameter("today", new \DateTime());
        return $query->getResult();
    }

    public function countOldExcursion()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(R.idrando) as nm FROM ExcursionBundle:Randonne R WHERE R.daterando <= :today")
            ->setParameter("today", new \DateTime());
        return $query->getResult();
    }

    public function countAllExcursion()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(R.idrando) as nm FROM ExcursionBundle:Randonne R");
        return $query->getResult();
    }

}