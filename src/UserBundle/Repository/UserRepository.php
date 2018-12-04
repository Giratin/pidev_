<?php
/**
 * Created by PhpStorm.
 * User: STA
 * Date: 03/12/2018
 * Time: 15:29
 */

namespace UserBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function countUsers()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(U.id) as nm FROM UserBundle:User U ");
        return $query->getResult();
    }

    public function countBlockedUsers()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(U.id) as nm FROM UserBundle:User U Where U.enabled = 0");
        return $query->getResult();
    }

    public function countEnabledUsers()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT count(U.id) as nm FROM UserBundle:User U Where U.enabled = 1");
        return $query->getResult();
    }


    public function EnabledUsers()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT U FROM UserBundle:User U Where U.enabled = 1");
        return $query->getResult();
    }

    public function BlockedUsers()
    {
        $query  = $this->getEntityManager()->createQuery("SELECT U FROM UserBundle:User U Where U.enabled = 0");
        return $query->getResult();
    }
}