<?php


namespace App\Entity;
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

    public function getScriptExec()
    {
        return $this->scriptExec;
    }


    public function setScriptExec($scriptExec)
    {
        $this->scriptExec = $scriptExec;
        return $this;
    }

}
