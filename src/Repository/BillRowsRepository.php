<?php

namespace App\Repository;

use App\Entity\BillRows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BillRows|null find($id, $lockMode = null, $lockVersion = null)
 * @method BillRows|null findOneBy(array $criteria, array $orderBy = null)
 * @method BillRows[]    findAll()
 * @method BillRows[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillRowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BillRows::class);
    }

    // /**
    //  * @return BillRows[] Returns an array of BillRows objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BillRows
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
