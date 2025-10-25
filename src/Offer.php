<?php
namespace Acme;

class Offer
{
    public string $productCode;
    public int $buyQty;
    public int $discountQty;
    public float $discountRate; // 0.5 = 50%

    /**
     * Construct
     * @param string $productCode
     * @param int    $buyQty
     * @param int    $discountQty
     * @param float  $discountRate
     */
    public function __construct(string $productCode, int $buyQty, int $discountQty, float $discountRate)
    {
        $this->productCode = $productCode;
        $this->buyQty = $buyQty;
        $this->discountQty = $discountQty;
        $this->discountRate = $discountRate;
    }

    /**
     * Apply offer to items in basket
     * @param array $items
     * @return float  total discount
     */
    public function apply(array $items): float
    {
        $totalDiscount = 0.0;
        if (!isset($items[$this->productCode])) {
            return 0.0;
        }

        $qty = $items[$this->productCode]['qty'];
        $price = $items[$this->productCode]['price'];

        // e.g., buy 1 get 2nd half price
        $eligiblePairs = intdiv($qty, $this->buyQty + $this->discountQty);
        $remaining = $qty % ($this->buyQty + $this->discountQty);

        // handle even pairs like 2, 4, 6
        $eligiblePairs = intdiv($qty, 2);
        $totalDiscount = $eligiblePairs * $price * $this->discountRate;

        return $totalDiscount;
    }
}
