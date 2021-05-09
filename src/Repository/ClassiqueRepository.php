<?php

namespace App\Repository;

use App\Entity\Classique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Classique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classique[]    findAll()
 * @method Classique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classique::class);
    }

     /**
      * @return Classique[] Returns an array of Classique objects
      */

    /*public function findByExampleField($pdf)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :pdf')
            ->setParameter('val', $pdf)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
*/
    public function findSousByCat($libelleCat)
    {
        return $this->createQueryBuilder('c')
            ->select('c.libelleSousCat')
            ->andWhere('c.libelleCat = :libelleCat')
            ->setParameter('libelleCat', $libelleCat)
            ->orderBy('c.libelleSousCat', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.libelleSousCat = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findAllSousCat()
    {
        return $this->createQueryBuilder('c')
            ->select('c.libelleSousCat')
            ->orderBy('c.libelleSousCat', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findAllAut()
    {
        return $this->createQueryBuilder('c')
            ->select('c.auteurLiv')
            ->orderBy('c.auteurLiv', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByWord($keyword){
        $query = $this->createQueryBuilder('a')
            ->where('a.auteurLiv LIKE :key')
            ->setParameter('key' , '%'.$keyword.'%')->getQuery();
        return $query->getResult();
    }
    public function findByTitre($keyword){
        $query = $this->createQueryBuilder('a')
            ->where('a.titreLiv LIKE :key')
            ->setParameter('key' , '%'.$keyword.'%')->getQuery();
        return $query->getResult();
    }
    public function findOneBySomeField($pdf): ?Classique
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cheminLiv = :val')
            ->setParameter('val', $pdf)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    }
