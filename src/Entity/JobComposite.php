<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobCompositeRepository::class)
 */
class JobComposite extends Job
{
    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="scriptExec")
     */
    private $listSousJobs;

    /**
     * @return mixed
     */
    public function getListSousJobs()
    {
        return $this->listSousJobs;
    }

    /**
     * @param mixed $listSousJobs
     * @return JobComposite
     */
    public function setListSousJobs($listSousJobs)
    {
        $this->listSousJobs = $listSousJobs;
        return $this;
    }


}
