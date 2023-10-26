<?php

namespace App\Repository;

use App\Entity\APPLIANCE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<APPLIANCE>
 *
 * @method APPLIANCE|null find($id, $lockMode = null, $lockVersion = null)
 * @method APPLIANCE|null findOneBy(array $criteria, array $orderBy = null)
 * @method APPLIANCE[]    findAll()
 * @method APPLIANCE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class APPLIANCERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, APPLIANCE::class);
    }

//    /**
//     * @return APPLIANCE[] Returns an array of APPLIANCE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?APPLIANCE
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
