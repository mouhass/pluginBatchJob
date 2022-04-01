<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=JobCronRepository::class)
 */
class JobCron extends Job
{
    /**
     * @ORM\ManyToOne(targetEntity=JobComposite::class, inversedBy="listSousJobs")
     */
    private $scriptExec;
    /**
     * @return mixed
     */
    public function getScriptExec()
    {
        return $this->scriptExec;
    }

    /**
     * @param mixed $scriptExec
     * @return JobCron
     */
    public function setScriptExec($scriptExec)
    {
        $this->scriptExec = $scriptExec;
        return $this;
    }

}
