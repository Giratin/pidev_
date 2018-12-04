<?php
/**
 * Created by PhpStorm.
 * User: STA
 * Date: 27/11/2018
 * Time: 23:44
 */

namespace EventBundle\Repository;


class ReservationeventRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfindMe($idUser, $idEvent)
    {
        $dql = $this
            ->getEntityManager()
            ->createQuery('SELECT R FROM EventBundle:Reservationevent R WHERE R.idevent = :idevent AND R.idclient = :idclient');
        $dql->setParameter(':idevent',$idEvent)
            ->setParameter(':idclient', $idUser);
        return $dql->getResult();
    }
}