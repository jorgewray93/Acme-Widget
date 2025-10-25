# Acme Widget Co - PHP Code Test

## Overview
This project is a **proof of concept shopping basket** implemented in PHP for *Acme Widget Co*.

It includes:
- A product catalogue.
- Delivery cost rules based on subtotal.
- Promotional offers (e.g., “Buy one red widget, get the second half price”).
- Unit tests with PHPUnit.

---

## Installation

Clone the repository and install dependencies:

```bash
composer install
```

Setup the internal server
```bash
php -S localhost:8000
```

Open in the browser

http://localhost:8000

---

## Usage Example

```php
use Acme\{Basket, Product, DeliveryRule, Offer};

$catalogue = [
  'R01' => new Product('R01', 'Red Widget', 32.95),
  'G01' => new Product('G01', 'Green Widget', 24.95),
  'B01' => new Product('B01', 'Blue Widget', 7.95),
];

$delivery = new DeliveryRule([
  50 => 4.95,
  90 => 2.95,
]);

$offer = new Offer('R01', 1, 1, 0.5); // buy 1, get 2nd half price

$basket = new Basket($catalogue, $delivery, [$offer]);
$basket->add('R01');
$basket->add('R01');

echo $basket->total(); // 54.37
```

---

## Running Tests

```bash
vendor/bin/phpunit
```

---

## Expected Totals

| Products | Expected Total |
|-----------|----------------|
| B01, G01 | 37.85 |
| R01, R01 | 54.37 |
| R01, G01 | 60.85 |
| B01, B01, R01, R01, R01 | 98.27 |

---

## Project Structure

```
acme-widget/
├── composer.json
├── src/
│   ├── Basket.php
│   ├── Product.php
│   ├── DeliveryRule.php
│   └── Offer.php
├── tests/
│   └── BasketTest.php
└── README.md
```

---

## Notes and Assumptions
- Written for **PHP 8.0+**.
- Uses **PSR-4 autoloading** via Composer.
- The delivery rules are ordered by subtotal thresholds.
- Offers can be extended easily by adding new `Offer` objects.
- All monetary calculations use floating-point numbers rounded to two decimals for simplicity.

---

## License
This code test is provided for educational and evaluation purposes.
