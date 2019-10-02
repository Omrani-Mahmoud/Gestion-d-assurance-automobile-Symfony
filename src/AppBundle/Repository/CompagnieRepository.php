<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Compagnie;

/**
 * CompagnieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompagnieRepository extends \Doctrine\ORM\EntityRepository
{
    public function getId($username){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from(Compagnie::class, 'u')
            ->where('u.username LIKE :username')
            ->setParameter('username', $username);

        return $qb->getQuery()->getResult();
    }
}
