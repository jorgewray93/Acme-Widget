<?php
require __DIR__ . '/vendor/autoload.php';

use Acme\{Basket, Product, DeliveryRule, Offer};

// Product Catalogue
$catalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95),
];

// Delivery Rules
$delivery = new DeliveryRule([
    50 => 4.95,
    90 => 2.95,
]);

$offer = new Offer('R01', 1, 1, 0.5); // buy one, second half price

$basket = new Basket($catalogue, $delivery, [$offer]);

// Example products added to basket
$basket->add('R01');
$basket->add('R01');
$basket->add('G01');

$total = $basket->total();

// Output
echo "<h2>Acme Widget Co</h2>";
echo "<p><strong>Products added:</strong></p>";
echo "<ul>";
echo "<li><b>R01-Red Widget</b> --- Regular price: 32.95 </li>";
echo "<li><b>R01-Red Widget</b> --- Regular price: 32.95</li>";
echo "<li><b>G01-Green Widget</b> --- Regular price: 24.95</li>";
echo "</ul>";
echo "<p><strong>Total:</strong> $" . number_format($total, 2) . "</p>";
