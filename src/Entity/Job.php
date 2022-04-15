<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorMap({"job" = "Job", "jobCron" = "JobCron","jobComposite" = "JobComposite"})
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */
    private $state;
    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;
    /**
     * @ORM\OneToMany(targetEntity=Admin::class)
     * @ORM\JoinColumn(nullable=true)
     * @ORM\Column(type="array", nullable=true)
     */
    private $listDestination = [];
    /**
     * @ORM\Column(type="datetime")
     */
    private $nextDateExec;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getListDestination(): ?array
    {
        return $this->listDestination;
    }

    public function setListDestination(array $listDestination): self
    {
        $this->listDestination = $listDestination;

        return $this;
    }

    public function getNextDateExec(): ?\DateTimeInterface
    {
        return $this->nextDateExec;
    }

    public function setNextDateExec(\DateTimeInterface $nextDateExec): self
    {
        $this->nextDateExec = $nextDateExec;

        return $this;
    }
}
