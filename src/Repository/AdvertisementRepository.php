<?php

namespace App\Repository;

use App\Entity\Advertisement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Advertisement>
 *
 * @method Advertisement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisement[]    findAll()
 * @method Advertisement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advertisement::class);
    }

    public function add(Advertisement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Advertisement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /// Récupération de toutes les annonces (+ nom de l'entreprise et type du contrat)
    public function getAllAdvertisementCompany(){
        // Utilisation de Doctrine
        $entityManager = $this->getEntityManager();

        // On effectue une requête Doctrine
        $query = $entityManager->createQuery(
            'SELECT a.id, a.Title, a.Description, a.Wages, a.Workingtime, c.Name, t.Label
            FROM App\Entity\Advertisement a
            JOIN a.CompanyId c
            JOIN a.TypeContractId t'
        );
        
        return $query->getResult();
    }

    /// Récupération de toutes les annonces par entreprise
    public function getAdvertisementByCompany($companyId){
        // Utilisation de Doctrine
        $entityManager = $this->getEntityManager();

        // On effectue une requête Doctrine
        $query = $entityManager->createQuery(
            'SELECT a.id, a.Title, a.Description, a.Wages, a.Workingtime, c.Name, t.Label
            FROM App\Entity\Advertisement a
            JOIN a.CompanyId c
            JOIN a.TypeContractId t
            WHERE a.CompanyId = :companyId
            '
        )->setParameter('companyId', $companyId);
        
        return $query->getResult();
    }

//    /**
//     * @return Advertisement[] Returns an array of Advertisement objects
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

//    public function findOneBySomeField($value): ?Advertisement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
