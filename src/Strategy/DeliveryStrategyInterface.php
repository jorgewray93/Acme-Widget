<?php
declare(strict_types=1);
namespace Acme\Strategy;

use Acme\Product;

interface DeliveryStrategyInterface
{
    /**
     * Summary of calculate
     * @param float $total
     * @return void
     */
    public function calculate(float $total): float;
}
