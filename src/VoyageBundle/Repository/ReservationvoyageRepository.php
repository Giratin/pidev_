<?php
/**
 * Created by PhpStorm.
 * User: Sirine
 * Date: 26/11/2018
 * Time: 00:56
 */

namespace VoyageBundle\Repository;
/**
 * ReservationvoyageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationvoyageRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfindReservation($idv,$idc)
    {
        $dql = $this->getEntityManager()
            ->createQuery('SELECT r FROM VoyageBundle:Reservationvoyage r WHERE r.voyage = :id and r.id= :idc');
        $dql->setParameter(':id',$idv)->setParameter('idc',$idc);

        return $dql->getResult();
    }
    public function countReservation($idc,$idv){
        $query=$this->getEntityManager()->createQuery("SELECT count(m.idreservation) as nmbre from VoyageBundle:Reservationvoyage m where m.id ='$idc' and m.voyage = '$idv'");
        return $query->getResult();
    }
     public function findByUser($idc){
         $query=$this->getEntityManager()->createQuery("SELECT r from VoyageBundle:Reservationvoyage r where r.id ='$idc'");
         return $query->getResult();
     }

}