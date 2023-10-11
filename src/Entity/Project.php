<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column(length: 255)]
    private ?string $province = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[ORM\Column]
    private ?float $surfaceArea = null;

    #[ORM\Column]
    private ?int $nbrApplications = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Phase::class)]
    private Collection $phase;



    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->deliverable = new ArrayCollection();
        $this->phase = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getSurfaceArea(): ?float
    {
        return $this->surfaceArea;
    }

    public function setSurfaceArea(float $surfaceArea): static
    {
        $this->surfaceArea = $surfaceArea;

        return $this;
    }

    public function getNbrApplications(): ?int
    {
        return $this->nbrApplications;
    }

    public function setNbrApplications(int $nbrApplications): static
    {
        $this->nbrApplications = $nbrApplications;

        return $this;
    }

    /**
     * @return Collection<int, Phase>
     */
    public function getPhase(): Collection
    {
        return $this->phase;
    }

    public function addPhase(Phase $phase): static
    {
        if (!$this->phase->contains($phase)) {
            $this->phase->add($phase);
            $phase->setProject($this);
        }

        return $this;
    }

    public function removePhase(Phase $phase): static
    {
        if ($this->phase->removeElement($phase)) {
            // set the owning side to null (unless already changed)
            if ($phase->getProject() === $this) {
                $phase->setProject(null);
            }
        }

        return $this;
    }

}
