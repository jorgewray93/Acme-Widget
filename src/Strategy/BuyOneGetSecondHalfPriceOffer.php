<?php
declare(strict_types=1);

namespace Acme\Strategy;

use Acme\Product;   
final class BuyOneGetSecondHalfPriceOffer implements OfferStrategyInterface
{
    /**
     * Apply Buy One Get Second Half Price offer to items
     * @param array $items
     * @return float
     */
    public function apply(array $items): float
    {
        $discount = 0.0;
        $counts = [];
        foreach ($items as $item) {
            $counts[$item->code][] = $item;
        }
        // Calculate discount
        foreach ($counts as $code => $products) {
            $quantity = count($products);
            if ($quantity >= 2) {
                $pairs = intdiv($quantity, 2);
                $price = $products[0]->price;
                $discount += ($price / 2) * $pairs;
            }
        }

        return $discount;
    }
}
