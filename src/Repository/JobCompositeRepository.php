<?php

namespace App\Repository;

use App\Entity\JobComposite;

use App\Entity\JobCron;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobComposite|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobComposite|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobComposite[]    findAll()
 * @method JobComposite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobCompositeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobComposite::class);
    }

    public function verifyJobCron(string $command,EntityManagerInterface $em){
//        return $this->createQueryBuilder('job')
//            ->andWhere('command in job.listSousJobs')
//            ->setParameter('val', $command)
//            ->getQuery()
//            ->getOneOrNullResult();

        $qb = $em->createQueryBuilder()
            ->select('j')
            ->from('JobComposite','j')
            ->andWhere(':command in j.listSousJobs')
            ->setParameter('command',$command)
            ->getQuery();
        return $qb;
    }


    public function findByName(string $name){
        return $this->createQueryBuilder('a')
            ->andWhere('a.name = :val')
            ->setParameter('val', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
