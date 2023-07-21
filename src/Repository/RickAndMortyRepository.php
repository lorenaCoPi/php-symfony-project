<?php

namespace App\Repository;

use App\Entity\RickAndMorty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RickAndMorty>
 *
 * @method RickAndMorty|null find($id, $lockMode = null, $lockVersion = null)
 * @method RickAndMorty|null findOneBy(array $criteria, array $orderBy = null)
 * @method RickAndMorty[]    findAll()
 * @method RickAndMorty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RickAndMortyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RickAndMorty::class);
    }

//    /**
//     * @return RickAndMorty[] Returns an array of RickAndMorty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RickAndMorty
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
