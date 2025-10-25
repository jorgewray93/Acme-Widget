<?php
namespace Acme\Tests;

use PHPUnit\Framework\TestCase;
use Acme\{Basket, Product, DeliveryRule, Offer};

class BasketTest extends TestCase
{
    private function createBasket(): Basket
    {
        $catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];

        $delivery = new DeliveryRule([
            50 => 4.95,
            90 => 2.95,
        ]);

        $offer = new Offer('R01', 1, 1, 0.5);

        return new Basket($catalogue, $delivery, [$offer]);
    }

    public function testExampleTotals(): void
    {
        $basket = $this->createBasket();

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}
