<?php

namespace App\Entity;

use App\Repository\APPLIANCERepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: APPLIANCERepository::class)]
class APPLIANCE
{
    

    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $Code = null;

    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    #[ORM\Column(length: 255)]
    private ?string $EconomyRating = null;

    #[ORM\Column(length: 255)]
    private ?string $Manufacture = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FabricationDate = null;

    #[ORM\Column]
    private ?int $Stock = null;

    

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): static
    {
        $this->Code = $Code;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getEconomyRating(): ?string
    {
        return $this->EconomyRating;
    }

    public function setEconomyRating(string $EconomyRating): static
    {
        $this->EconomyRating = $EconomyRating;

        return $this;
    }

    public function getManufacture(): ?string
    {
        return $this->Manufacture;
    }

    public function setManufacture(string $Manufacture): static
    {
        $this->Manufacture = $Manufacture;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getFabricationDate(): ?\DateTimeInterface
    {
        return $this->FabricationDate;
    }

    public function setFabricationDate(\DateTimeInterface $FabricationDate): static
    {
        $this->FabricationDate = $FabricationDate;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): static
    {
        $this->Stock = $Stock;

        return $this;
    }
}
