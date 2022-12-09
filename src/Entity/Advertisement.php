<?php

namespace App\Entity;

use App\Repository\AdvertisementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertisementRepository::class)]
class Advertisement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Wages = null;

    #[ORM\Column]
    private ?int $Workingtime = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    public ?Company $CompanyId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete:"CASCADE")]
    private ?TypeContract $TypeContractId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getWages(): ?int
    {
        return $this->Wages;
    }

    public function setWages(int $Wages): self
    {
        $this->Wages = $Wages;

        return $this;
    }

    public function getWorkingtime(): ?int
    {
        return $this->Workingtime;
    }

    public function setWorkingtime(int $Workingtime): self
    {
        $this->Workingtime = $Workingtime;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->CompanyId;
    }

    public function setCompanyId(?Company $CompanyId): self
    {
        $this->CompanyId = $CompanyId;

        return $this;
    }

    public function getTypeContractId(): ?TypeContract
    {
        return $this->TypeContractId;
    }

    public function setTypeContractId(?TypeContract $TypeContractId): self
    {
        $this->TypeContractId = $TypeContractId;

        return $this;
    }
}
