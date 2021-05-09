<?php

namespace App\Repository;

use App\Entity\Perikopa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Perikopa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perikopa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perikopa[]    findAll()
 * @method Perikopa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerikopaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perikopa::class);
    }

    // /**
    //  * @return Perikopa[] Returns an array of Perikopa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Perikopa
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
