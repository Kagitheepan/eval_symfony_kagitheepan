<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository pour l'entité Product.
 * Contient les méthodes de récupération personnalisées pour les produits.
 * 
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Recherche des produits par nom.
     * 
     * @param string $query Le terme de recherche.
     * @return Product[] Liste des produits correspondants.
     */
    public function findBySearchQuery(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
