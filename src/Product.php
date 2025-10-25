<?php
namespace Acme;

class Product
{
    public string $code;
    public string $name;
    public float $price;

    /**
     * Construct
     * @param string $code
     * @param string $name
     * @param float  $price
     */
    public function __construct(string $code, string $name, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }
}
