<?php

namespace App\Message;

class LogCommand
{
    private $nameCommand;
    private $nomJobComposite;
    private $dernierSousJob;
    private $idJobCron;
    public function __construct(string $nameCommand,string $idJobCron ,string $nomJobComposite,string $dernierSousJob)
    {
        $this->nameCommand = $nameCommand;
        $this->nomJobComposite = $nomJobComposite;
        $this->dernierSousJob = $dernierSousJob;
        $this->idJobCron = $idJobCron;
    }

    /**
     * @return string
     */
    public function getIdJobCron(): string
    {
        return $this->idJobCron;
    }

    /**
     * @param string $idJobCron
     * @return LogCommand
     */
    public function setIdJobCron(string $idJobCron): LogCommand
    {
        $this->idJobCron = $idJobCron;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomJobComposite(): string
    {
        return $this->nomJobComposite;
    }

    /**
     * @param string $nomJobComposite
     * @return LogCommand
     */
    public function setNomJobComposite(string $nomJobComposite): LogCommand
    {
        $this->nomJobComposite = $nomJobComposite;
        return $this;
    }

    /**
     * @return string
     */
    public function getDernierSousJob(): string
    {
        return $this->dernierSousJob;
    }

    /**
     * @param string $dernierSousJob
     * @return LogCommand
     */
    public function setDernierSousJob(string $dernierSousJob): LogCommand
    {
        $this->dernierSousJob = $dernierSousJob;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameCommand(): string
    {
        return $this->nameCommand;
    }



}
