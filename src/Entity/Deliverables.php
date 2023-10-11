<?php

namespace App\Entity;

use App\Repository\DeliverablesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: DeliverablesRepository::class)]
#[Vich\Uploadable]
class Deliverables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping:"deliverbale",fileNameProperty: 'deliverable1Name')]
    private ?File $deliverable1File;

    #[Vich\UploadableField(mapping:"deliverbale",fileNameProperty: 'deliverable2Name')]
    private ?File $deliverable2File;

    #[ORM\Column(nullable: true)]
    private ?string $deliverable1Name = null;

    #[ORM\Column(nullable: true)]
    private ?string $deliverable2Name = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $dateSoumission = null;

    #[ORM\ManyToOne(inversedBy: 'deliverable')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Phase $phase = null;


    public function __construct()
    {
        $this->dateSoumission = new \DateTimeImmutable();
    }

    public function setDeliverable1File($deliverable1File = null): void
    {
        $this->deliverable1File = $deliverable1File;

        if (null !== $deliverable1File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDeliverable1File(): ?File
    {
        return $this->deliverable1File;
    }

    public function setDeliverable2File($deliverable2File = null): void
    {
        $this->deliverable2File = $deliverable2File;

        if (null !== $deliverable2File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDeliverable2File(): ?File
    {
        return $this->deliverable2File;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDeliverable1Name(?string $deliverable1Name): void
    {
        $this->deliverable1Name = $deliverable1Name;
    }

    public function getDeliverable1Name(): ?string
    {
        return $this->deliverable1Name;
    }
    public function setDeliverable2Name(?string $deliverable2Name): void
    {
        $this->deliverable2Name = $deliverable2Name;
    }

    public function getDeliverable2Name(): ?string
    {
        return $this->deliverable2Name;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDateSoumission(): ?\DateTimeImmutable
    {
        return $this->dateSoumission;
    }

    /**
     * @param \DateTimeImmutable|null $dateSoumission
     */
    public function setDateSoumission(?\DateTimeImmutable $dateSoumission): void
    {
        $this->dateSoumission = $dateSoumission;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): static
    {
        $this->phase = $phase;

        return $this;
    }
}
