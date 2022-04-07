<?php


namespace App\Entity;
use App\Repository\JobCronRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=JobCronRepository::class)
 */
class JobCron extends Job
{
    /**
     * @ORM\Column(type="string")
     */
    private $scriptExec;

    /**
     * @ORM\ManyToMany(targetEntity=JobComposite::class)
     */
    private $jobsComposites;



    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="ownerCron")
     */
    public $createdBy;

    /**
     * @return mixed
     */
    public function getJobCompositeHistorique()
    {
        return $this->jobCompositeHistorique;
    }

    /**
     * @param mixed $jobCompositeHistorique
     * @return JobCron
     */
    public function setJobCompositeHistorique($jobCompositeHistorique)
    {
        $this->jobCompositeHistorique = $jobCompositeHistorique;
        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity=JobComposite::class, mappedBy="historiqueSousJobs")
     */
    private $jobCompositeHistorique;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="jobCron", orphanRemoval=true)
     */
    private $historique;

    public function __construct()
    {
        $this->historique = new ArrayCollection();
    }






    /**
     * @return mixed
     */
    public function getJobsComposites()
    {
        return $this->jobsComposites;
    }

    /**
     * @param mixed $jobsComposites
     * @return JobCron
     */
    public function setJobsComposites($jobsComposites)
    {
        $this->jobsComposites = $jobsComposites;
        return $this;
    }

    public function getScriptExec()
    {
        return $this->scriptExec;
    }


    public function setScriptExec($scriptExec)
    {
        $this->scriptExec = $scriptExec;
        return $this;
    }
    public function getCreatedBy(): ?Admin
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Admin $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
    public function __toString() {
        return $this->scriptExec;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historique->contains($historique)) {
            $this->historique[] = $historique;
            $historique->setJobCron($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historique->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getJobCron() === $this) {
                $historique->setJobCron(null);
            }
        }

        return $this;
    }

}
