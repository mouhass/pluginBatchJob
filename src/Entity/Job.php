<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;


abstract class Job
{
    private $id;
    private $name;
    private $expression;
    private $state;
    private $actif;
    private $listDestination = [];
    private $nextDateExec;
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


}
