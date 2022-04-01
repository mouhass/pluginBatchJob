<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;


/**
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $expression;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="array")
     */
    private $listDestination = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $nextDateExec;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="name")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="createdAt")
     */
    private $historique = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state): self
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

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getHistorique(): ?array
    {
        return $this->historique;
    }

    public function setHistorique(?array $historique): self
    {
        $this->historique = $historique;

        return $this;
    }
}
