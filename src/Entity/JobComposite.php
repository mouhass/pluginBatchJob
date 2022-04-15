<?php

namespace App\Entity;
use App\Repository\JobCompositeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=JobCompositeRepository::class)
 */
class JobComposite extends Job
{


    /**
     * @ORM\OneToMany(targetEntity=JobCron::class, mappedBy="relationHistJobComp")
     * @ORM\JoinColumn(nullable=false)
     */
    private $historiqueSousJob;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="jobComposites", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="string")
     */

    private $test;

    /**
     * @ORM\ManyToMany(targetEntity=JobCron::class, inversedBy="jobComposites")
     */
    private $listSousJobs;
    public function __construct()
    {
        $this->listSousJobs = new ArrayCollection();
        $this->historiqueSousJob = new ArrayCollection();
    }



    /**
     * @return Collection<int, JobCron>
     */
    public function getHistoriqueSousJob(): Collection
    {
        return $this->historiqueSousJob;
    }

    public function addHistoriqueSousJob(JobCron $historiqueSousJob): self
    {
        if (!$this->historiqueSousJob->contains($historiqueSousJob)) {
            $this->historiqueSousJob[] = $historiqueSousJob;
        }

        return $this;
    }

    public function removeHistoriqueSousJob(JobCron $historiqueSousJob): self
    {
        $this->historiqueSousJob->removeElement($historiqueSousJob);

        return $this;
    }

    public function getCreatedBy(): ?Admin
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Admin $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, JobCron>
     */
    public function getListSousJobs(): Collection
    {
        return $this->listSousJobs;
    }

    public function addListSousJob(JobCron $listSousJob): self
    {
        if (!$this->listSousJobs->contains($listSousJob)) {
            $this->listSousJobs[] = $listSousJob;
        }

        return $this;
    }

    public function removeListSousJob(JobCron $listSousJob): self
    {
        $this->listSousJobs->removeElement($listSousJob);

        return $this;
    }
}
