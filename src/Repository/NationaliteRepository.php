<?php

namespace App\Repository;

use App\Entity\Nationalite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nationalite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nationalite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nationalite[]    findAll()
 * @method Nationalite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationaliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nationalite::class);
    }

    // /**
    //  * @return Nationalite[] Returns an array of Nationalite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nationalite
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
