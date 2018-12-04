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

    public function getAllAboutExcursion($id)
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R FROM ExcursionBundle:Randonne R WHERE R.idrando = :id");
        $query->setParameter('id', $id);
        return $query->getResult();
    }

    public function getAllMyExcursions($idUser)
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R.idRandonne FROM ExcursionBundle:Reservationrandonne R WHERE R.idClient = :id");
        $query->setParameter('id', $idUser);
        return $query->getResult();
    }

    public function myFindExcursion($idRando)
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R FROM ExcursionBundle:Randonne R WHERE R.idrando IN (:id)");
        $query->setParameter(':id', $idRando);
        return $query->getResult();
    }


    public function topExcursion()
    { //CURRENT_TIMESTAMP()
        $query  = $this->getEntityManager()
            ->createQuery('SELECT R FROM ExcursionBundle:Randonne R WHERE R.nbreclient=
                               (SELECT MAX(C.nbreclient) FROM ExcursionBundle:Randonne C where (C.daterando) > CURRENT_TIMESTAMP() )');
        return $query->getResult();
    }

    public function gainOld()
    {
        $query  = $this->getEntityManager()
            ->createQuery('SELECT R FROM ExcursionBundle:Randonne R WHERE NOT(R.nbreclient=0) AND (R.daterando) < CURRENT_TIMESTAMP()');
        return $query->getResult();
    }

    public function gainNew()
    {
        $query  = $this->getEntityManager()
            ->createQuery('SELECT R FROM ExcursionBundle:Randonne R WHERE NOT(R.nbreclient=0) AND (R.daterando) > CURRENT_TIMESTAMP()');
        return $query->getResult();
    }

}