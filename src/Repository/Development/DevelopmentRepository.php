<?php

namespace App\Repository\Development;

use App\Entity\Development\Development;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Development|null find($id, $lockMode = null, $lockVersion = null)
 * @method Development|null findOneBy(array $criteria, array $orderBy = null)
 * @method Development[]    findAll()
 * @method Development[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevelopmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Development::class);
    }

    public function findDocBySection($title)
    {
        $sql = "
                SELECT
                  partial e.{id,title,content},
                  partial ljco.{id, title}
            FROM App\Entity\Development\Development e
            INNER JOIN e.section ljco
            WHERE ljco.id = :sectionId
        ";
        $aParameter = [
            'sectionId' => $title
        ];
        return $this->getEntityManager()->createQuery($sql)->setParameters($aParameter)->getResult();
    }

    // /**
    //  * @return Development[] Returns an array of Development objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Development
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
