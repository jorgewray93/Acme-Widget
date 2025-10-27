<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Acme\{Basket, Product, DeliveryRule, Offer};
use Acme\Strategy\{StandardDeliveryStrategy, HalfPriceRedWidgetOffer};
final class BasketTest extends TestCase {
    private Basket $basket;
    protected function setUp(): void {
        $products=['R01'=>new Product('R01','Red Widget',32.95),'G01'=>new Product('G01','Green Widget',24.95),'B01'=>new Product('B01','Blue Widget',7.95)];
        $deliveryRules=[new DeliveryRule(0,50,4.95),new DeliveryRule(50,90,2.95),new DeliveryRule(90,INF,0)];
        $offers=[new Offer('R01','half-price second',new HalfPriceRedWidgetOffer())];
        $this->basket=new Basket($products,new StandardDeliveryStrategy($deliveryRules),$offers);
    }
    public function testBasketTotals(): void {
        $this->basket->add('B01'); $this->basket->add('G01'); $this->assertEquals(37.85,$this->basket->total());
        $this->basket = clone $this->basket; $this->basket->add('R01'); $this->basket->add('R01'); $this->assertEquals(54.37,$this->basket->total());
    }
}