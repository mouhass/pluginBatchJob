<?php
namespace App\Entity;
use App\Repository\JobCompositeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobCompositeRepository::class)
 */
class JobComposite extends Job
{
    /**
     * @ORM\ManyToOne(targetEntity=JobCron::class)
     */
    private $listSousJobs = [];
    /**
     * @ORM\ManyToOne(targetEntity=JobCron::class, inversedBy="jobCompositeHistorique")
     */
    private $historiqueSousJobs;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="ownerComposite")
     */
    public $createdBy;

    /**
     * @return array
     */
    public function getHistoriqueSousJobs(): array
    {
        return $this->historiqueSousJobs;
    }

    /**
     * @param mixed $historiqueSousJobs
     * @return JobComposite
     */
    public function setHistoriqueSousJobs($historiqueSousJobs)
    {
        $this->historiqueSousJobs = $historiqueSousJobs;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     * @return JobComposite
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }






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
