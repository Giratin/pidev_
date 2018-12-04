<?php
/**
 * Created by PhpStorm.
 * User: STA
 * Date: 27/11/2018
 * Time: 23:44
 */

namespace ExcursionBundle\Repository;


class ReservationrandonneRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfindMe($idUser, $idRando)
    {
        $dql = $this
            ->getEntityManager()
            ->createQuery('SELECT R FROM ExcursionBundle:Reservationrandonne R WHERE R.idRandonne = :idr AND R.idClient = :idc');
        $dql->setParameter(':idr',$idRando)
        ->setParameter(':idc', $idUser);
        return $dql->getResult();
    }
}