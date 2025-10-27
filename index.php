<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Acme\Product;
use Acme\Basket;
use Acme\DeliveryRule;
use Acme\Strategy\StandardDeliveryStrategy;
use Acme\Strategy\BuyOneGetSecondHalfPriceOffer;    


$catalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95),
];

// Strategy Pattern
$deliveryRules = [
    new DeliveryRule(0, 50, 4.95),
    new DeliveryRule(50, 90, 2.95),
    new DeliveryRule(90, INF, 0.00),
];
$deliveryStrategy = new StandardDeliveryStrategy($deliveryRules);

$offers = [
    new BuyOneGetSecondHalfPriceOffer(),
];

// setup basket
$basket = new Basket($catalogue, $deliveryStrategy, $offers);


$examples = [
    ['B01', 'G01'],                  // Total esperado: $37.85
    ['R01', 'R01'],                  // Total esperado: $54.37
    ['R01', 'G01'],                  // Total esperado: $60.85
    ['B01', 'B01', 'R01', 'R01', 'R01'], // Total esperado: $98.27
];

foreach ($examples as $items) {
    $basket = new Basket($catalogue, $deliveryStrategy, $offers);
    foreach ($items as $code) {
        $basket->add($code);
    }

    echo "Productos: " . implode(', ', $items) . PHP_EOL;
    echo "Total: $" . number_format($basket->total(), 2) . PHP_EOL;
    echo str_repeat('-', 40) . PHP_EOL;
}
