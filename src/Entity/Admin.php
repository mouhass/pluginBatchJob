<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
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
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=JobCron::class, mappedBy="createdBy", orphanRemoval=true, cascade={"persist"})
     */
    private $jobCrons;

    /**
     * @ORM\OneToMany(targetEntity=JobComposite::class, mappedBy="createdBy", orphanRemoval=true, cascade={"persist"})
     */
    private $jobComposites;



    public function __construct()
    {
        $this->jobCrons = new ArrayCollection();
        $this->jobComposites = new ArrayCollection();
    }
public function __toString()
{
    return $this->getName();
}

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, JobCron>
     */
    public function getJobCrons(): Collection
    {
        return $this->jobCrons;
    }

    public function addJobCron(JobCron $jobCron): self
    {
        if (!$this->jobCrons->contains($jobCron)) {
            $this->jobCrons[] = $jobCron;
            $jobCron->setCreatedBy($this);
        }

        return $this;
    }

    public function removeJobCron(JobCron $jobCron): self
    {
        if ($this->jobCrons->removeElement($jobCron)) {
            // set the owning side to null (unless already changed)
            if ($jobCron->getCreatedBy() === $this) {
                $jobCron->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JobComposite>
     */
    public function getJobComposites(): Collection
    {
        return $this->jobComposites;
    }

    public function addJobComposite(JobComposite $jobComposite): self
    {
        if (!$this->jobComposites->contains($jobComposite)) {
            $this->jobComposites[] = $jobComposite;
            $jobComposite->setCreatedBy($this);
        }

        return $this;
    }

    public function removeJobComposite(JobComposite $jobComposite): self
    {
        if ($this->jobComposites->removeElement($jobComposite)) {
            // set the owning side to null (unless already changed)
            if ($jobComposite->getCreatedBy() === $this) {
                $jobComposite->setCreatedBy(null);
            }
        }

        return $this;
    }


}
