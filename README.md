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
## Commands

Clone the repository and install dependencies:

```bash
composer install
```

Setup the internal server
```bash
docker compose up -d --build
docker compose exec app bash
```

Open in the browser

http://localhost:8080

---

## Running Tests

```bash
composer test
```

## Running Analyse 

```bash
composer analyse
```

---

## Project Structure

```
acme-widget/
├── composer.json
├── Dockerfile
├── docker-compose.yml
├── index.php
├── phpstan.neon
├── phpunit.xlm
├── src/
│   ├── Strategy
│   │   ├── DeliveryStrategyInterface.php
│   │   ├── BuyOneGetSecondHalfPriceOffer.php
│   │   └── OfferStrategyInterface.php
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
