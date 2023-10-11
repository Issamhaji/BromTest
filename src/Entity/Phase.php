<?php

namespace App\Entity;

use App\Repository\PhaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhaseRepository::class)]
class Phase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $value = null;

    #[ORM\ManyToOne(inversedBy: 'phase')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\OneToMany(mappedBy: 'phase', targetEntity: Deliverables::class)]
    private Collection $deliverable;

    public function __construct()
    {
        $this->deliverable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Deliverables>
     */
    public function getDeliverable(): Collection
    {
        return $this->deliverable;
    }

    public function addDeliverable(Deliverables $deliverable): static
    {
        if (!$this->deliverable->contains($deliverable)) {
            $this->deliverable->add($deliverable);
            $deliverable->setPhase($this);
        }

        return $this;
    }

    public function removeDeliverable(Deliverables $deliverable): static
    {
        if ($this->deliverable->removeElement($deliverable)) {
            // set the owning side to null (unless already changed)
            if ($deliverable->getPhase() === $this) {
                $deliverable->setPhase(null);
            }
        }

        return $this;
    }
}
