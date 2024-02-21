<?php

namespace App\Repository;

use App\Entity\Solicitudes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Solicitudes>
 *
 * @method Solicitudes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Solicitudes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Solicitudes[]    findAll()
 * @method Solicitudes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitudesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitudes::class);
    }

//    /**
//     * @return Solicitudes[] Returns an array of Solicitudes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Solicitudes
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
