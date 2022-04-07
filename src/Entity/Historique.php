<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueRepository::class)
 */
class Historique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=JobCron::class,inversedBy="historique")
     */
    private $historiqueJobCron;

    /**
     * @ORM\ManyToOne(targetEntity=JobCron::class, inversedBy="historique")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobCron;

    /**
     * @return mixed
     */
    public function getHistoriqueJobCron()
    {
        return $this->historiqueJobCron;
    }

    /**
     * @param mixed $historiqueJobCron
     * @return Historique
     */
    public function setHistoriqueJobCron($historiqueJobCron)
    {
        $this->historiqueJobCron = $historiqueJobCron;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getJobCron(): ?JobCron
    {
        return $this->jobCron;
    }

    public function setJobCron(?JobCron $jobCron): self
    {
        $this->jobCron = $jobCron;

        return $this;
    }
}
