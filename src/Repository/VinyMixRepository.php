<?php

namespace App\Repository;

use App\Entity\VinyMix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VinyMix>
 *
 * @method VinyMix|null find($id, $lockMode = null, $lockVersion = null)
 * @method VinyMix|null findOneBy(array $criteria, array $orderBy = null)
 * @method VinyMix[]    findAll()
 * @method VinyMix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinyMixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VinyMix::class);
    }

    /**
     * @return VinyMix[] Returns an array of VinyMix objects
     */
    public function findAllMixesByVote(string $genre=null): array
    {
       $queryBuilder= $this->createQueryBuilder('mix')
       ->orderBy('mix.votes','DESC');
            if($genre){
                $queryBuilder->andWhere('mix.genre = :val');
                $queryBuilder->setParameter('val', $genre);
        }
           return $queryBuilder->getQuery()
           ->getResult();
        ;
    }

    public function findOneBySomeField($id): ?VinyMix
    {
        return $this->createQueryBuilder('mixById')
           ->andWhere('mixById.id = :val')
           ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
