<?php

namespace App\Repository;

use App\Entity\Autorise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Autorise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Autorise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Autorise[]    findAll()
 * @method Autorise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autorise::class);
    }


    public function findAuto($idUser,$chemin)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.idUser = :idUser')
            ->andWhere('a.cheminLivre = :chemin')
            ->setParameter('idUser', $idUser)
            ->setParameter('chemin', $chemin)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?Autorise
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
