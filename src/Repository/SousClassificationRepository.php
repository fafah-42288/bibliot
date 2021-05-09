<?php

namespace App\Repository;

use App\Entity\SousClassification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SousClassification|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousClassification|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousClassification[]    findAll()
 * @method SousClassification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousClassificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousClassification::class);
    }

    // /**
    //  * @return SousClassification[] Returns an array of SousClassification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousClassification
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
