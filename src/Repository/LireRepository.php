<?php

namespace App\Repository;

use App\Entity\Lire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lire[]    findAll()
 * @method Lire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lire::class);
    }
    public function findHistorique($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.idUser = :val')
            ->setParameter('val', $value)
            ->orderBy('l.dateLire','DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Lire[] Returns an array of Lire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lire
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
