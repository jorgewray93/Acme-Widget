<?php
declare(strict_types=1);
namespace Acme\Strategy;

use Acme\DeliveryRule;

final class StandardDeliveryStrategy implements DeliveryStrategyInterface
{
    /**
     * StandardDeliveryStrategy constructor
     * @param DeliveryRule[] $rules
     */
    public function __construct(
        private readonly array $rules // array of DeliveryRule
    ) {}

    /**
     * Calculate delivery charge based on total amount
     * @param float $total
     * @return float
     */
    public function calculate(float $total): float
    {
        foreach ($this->rules as $rule) {
            if ($total >= $rule->minAmount && $total < $rule->maxAmount) {
                return $rule->charge;
            }
        }
        return 0.0;
    }
}
