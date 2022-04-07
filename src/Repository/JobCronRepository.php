<?php


namespace App\Repository;
use App\Entity\Job;
use App\Entity\JobCron;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobCron|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobCron|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobCron[]    findAll()
 * @method JobCron[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobCronRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobCron::class);
    }

    public function allCommands(){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT j
            FROM App\Entity\JobCron j')
        ->getResult();
        return $query;
    }


}
