<?php
namespace Acme;

class DeliveryRule
{
    private array $rules; 

    public function __construct(array $rules)
    {
        $this->rules = $rules;
        ksort($this->rules);
    }

    /**
     * Get delivery cost based on subtotal
     * @param float  $subtotal
     * @return float
     */
    public function getCost(float $subtotal): float
    {
        foreach ($this->rules as $limit => $cost) {
            if ($subtotal < $limit) {
                return $cost;
            }
        }
        return 0.0;
    }
}
