<?php
namespace Acme;

class Basket
{
    private array $catalogue;
    private DeliveryRule $deliveryRule;
    private array $offers;
    private array $items = [];

    /**
     * Construct
     * @param array        $catalogue
     * @param DeliveryRule $deliveryRule
     * @param array        $offers
     */
    public function __construct(array $catalogue, DeliveryRule $deliveryRule, array $offers = [])
    {
        $this->catalogue = $catalogue;
        $this->deliveryRule = $deliveryRule;
        $this->offers = $offers;
    }

    /**
     * Add product to basket
     * @param string $productCode
     * @return void
     */
    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \InvalidArgumentException("Unknown product code: {$productCode}");
        }

        if (!isset($this->items[$productCode])) {
            $this->items[$productCode] = [
                'price' => $this->catalogue[$productCode]->price,
                'qty' => 0
            ];
        }
        $this->items[$productCode]['qty']++;
    }

    /**
     * Calculate total cost
     * @return float
     */
    public function total(): float
    {
        $subtotal = 0.0;
        foreach ($this->items as $productCode => $data) {
            $subtotal += $data['price'] * $data['qty'];
        }

        // Apply offers
        $discount = 0.0;
        foreach ($this->offers as $offer) {
            $discount += $offer->apply($this->items);
        }
        $subtotal -= $discount;

        // Apply delivery
        $delivery = $this->deliveryRule->getCost($subtotal);

        return round($subtotal + $delivery, 2);
    }
}
