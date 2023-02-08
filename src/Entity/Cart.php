<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $cartId = null;

    #[ORM\Column(type: 'integer')]
    private int $productId;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string')]
    private string $purchaseIdentifier;

    #[ORM\Column(type: 'string')]
    private string $productName;

    #[ORM\Column(type: 'integer')]
    private int $unitPrice;

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function setCartId(string $cartId): self
    {
        $this->cartId = $cartId;

        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPurchaseIdentifier(): string
    {
        return $this->purchaseIdentifier;
    }

    public function setPurchaseIdentifier(string $purchaseIdentifier): void
    {
        $this->purchaseIdentifier = $purchaseIdentifier;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param  string  $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    /**
     * @param  int  $unitPrice
     */
    public function setUnitPrice(int $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }
}
