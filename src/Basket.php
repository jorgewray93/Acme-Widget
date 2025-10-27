<?php
declare(strict_types=1);
namespace Acme;
use Acme\Strategy\DeliveryStrategyInterface;
final class Basket {
    private array $items = [];

    /**
     * Basket constructor.
     * @param array<string, Product> $products
     * @param DeliveryStrategyInterface $deliveryStrategy
     * @param array<Offer> $offers
     */
    public function __construct(
        private readonly array $products, 
        private readonly DeliveryStrategyInterface $deliveryStrategy, 
        private readonly array $offers
    ) {}

    /**
     * Add product to basket by product code
     * @param string $productCode
     * @throws \InvalidArgumentException
     */
    public function add(string $productCode): void { 
        if (!isset($this->products[$productCode])) throw new \InvalidArgumentException("Unknown product code $productCode"); 
        $this->items[] = $this->products[$productCode]; 
    }

    /**
     * Calculate total price including delivery and offers
     * @return float
     */
    public function total(): float {
        $items = $this->items;
        foreach ($this->offers as $offer) { $items = $offer->strategy->apply($items); }
        $subtotal = array_sum(array_map(fn($i) => $i->price, $items));
        $delivery = $this->deliveryStrategy->calculate($subtotal);
        return round($subtotal + $delivery, 2);
    }
}