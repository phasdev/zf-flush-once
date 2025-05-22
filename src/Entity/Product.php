<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $pricingCurrency = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPricingCurrency(): ?Currency
    {
        return $this->pricingCurrency;
    }

    public function setPricingCurrency(?Currency $pricingCurrency): static
    {
        $this->pricingCurrency = $pricingCurrency;

        return $this;
    }
}
