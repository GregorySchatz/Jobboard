<?php

namespace App\Repository;

use App\Entity\JobApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobApplication>
 *
 * @method JobApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobApplication[]    findAll()
 * @method JobApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobApplication::class);
    }

    public function add(JobApplication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobApplication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /// Récupération de toutes les candidatures par entreprise
    public function getJobApplicationsByCompany($companyId){
        // Utilisation de Doctrine
        $entityManager = $this->getEntityManager();

        // On effectue une requête Doctrine
        $query = $entityManager->createQuery(
            'SELECT a.id, a.Title, a.Description, a.Wages, a.Workingtime, c.Name, t.Label, 
                    j.Message, j.Firstname, j.Lastname, j.Email, j.Phone
            FROM App\Entity\JobApplication j
            JOIN j.AdvertisementId a
            JOIN a.TypeContractId t
            JOIN a.CompanyId c
            WHERE a.CompanyId = :companyId
            '
        )->setParameter('companyId', $companyId);
        
        return $query->getResult();
    }

    ///Suppression des candidatures par annonce
    public function deleteJobApplicationsByAdvertisement($advertisementId){
        // Utilisation de Doctrine
        $entityManager = $this->getEntityManager();

        // On effectue une requête Doctrine
        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\JobApplication j
            WHERE j.AdvertisementId = :advertisementId
            '
        )->setParameter('advertisementId', $advertisementId);
        
        return $query->getResult();
    }

//    /**
//     * @return JobApplication[] Returns an array of JobApplication objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobApplication
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
