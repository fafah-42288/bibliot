<?php

namespace App\Repository;

use App\Entity\Mofonaina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Mofonaina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mofonaina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mofonaina[]    findAll()
 * @method Mofonaina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MofonainaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mofonaina::class);
    }

    // /**
    //  * @return Mofonaina[] Returns an array of Mofonaina objects
    //  */

    public function getDernier($daty)
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.date', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }


    public function getMofo($daty): ?Mofonaina
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.date = :val')
            ->setParameter('val', $daty)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
