<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    /**
     * @return Products[] Returns an array of Products objects
     */
    public function findByCats($id, $skip, $limit)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.category = :category')
            ->setParameter('category', $id)
            ->setMaxResults($limit)
            ->setFirstResult($skip)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Products[] Returns an array of Products objects
     */
    public function findByCatsCount($id)
    {
        return count($this->createQueryBuilder('p')
            ->andWhere('p.category = :category')
            ->setParameter('category', $id)
            ->getQuery()
            ->getResult());
    }
}
