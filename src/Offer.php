<?php
declare(strict_types=1);
namespace Acme;
use Acme\Strategy\OfferStrategyInterface;
final class Offer {
    /**
     * Offer constructor
     * @param string $code
     * @param string $description
     * @param OfferStrategyInterface $strategy
     */
    public function __construct(
        public readonly string $code,
        public readonly string $description, 
        public readonly OfferStrategyInterface $strategy
    ) {}
}