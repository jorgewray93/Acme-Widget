<?php
declare(strict_types=1);
namespace Acme\Strategy;

interface OfferStrategyInterface
{
    /**
     * Apply offer to items
     * @param array $items
     * @return array
     */
    public function apply(array $items): array; 
}
