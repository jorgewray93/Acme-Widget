<?php
declare(strict_types=1);
namespace Acme;
final class DeliveryRule {
    /**
     * Delivery rule constructor
     * @param float $minAmount
     * @param float $maxAmount
     * @param float $charge
     */
    public function __construct(
        public readonly float $minAmount, 
        public readonly float $maxAmount,
         public readonly float $charge
    ) {}
}