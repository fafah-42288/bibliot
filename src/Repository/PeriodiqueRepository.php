<?php

namespace App\Repository;

use App\Entity\Periodique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Periodique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Periodique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Periodique[]    findAll()
 * @method Periodique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Periodique::class);
    }
    public function findByWord($keyword){
        $query = $this->createQueryBuilder('a')
            ->where('a.titrePer LIKE :key')->orWhere('a.auteurPer LIKE :key')
            ->setParameter('key' , '%'.$keyword.'%')->getQuery();
        return $query->getResult();
    }
    // /**
    //  * @return Periodique[] Returns an array of Periodique objects
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
    public function findOneBySomeField($value): ?Periodique
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
