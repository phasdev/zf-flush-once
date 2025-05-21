<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    /**
     * @var Collection<int, Topping>
     */
    #[ORM\OneToMany(targetEntity: Topping::class, mappedBy: 'pizza', orphanRemoval: true)]
    private Collection $toppings;

    public function __construct()
    {
        $this->toppings = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Topping>
     */
    public function getToppings(): Collection
    {
        return $this->toppings;
    }

    public function addTopping(Topping $topping): self
    {
        if (!$this->toppings->contains($topping)) {
            $this->toppings->add($topping);
            $topping->setPizza($this);
        }

        return $this;
    }

    public function removeTopping(Topping $topping): static
    {
        if ($this->toppings->removeElement($topping)) {
            // set the owning side to null (unless already changed)
            if ($topping->getPizza() === $this) {
                $topping->setPizza(null);
            }
        }

        return $this;
    }
}
