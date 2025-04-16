<?php

namespace App\Services;

class BasketService
{
    protected $catalog;
    protected $deliveryRules;
    protected $offers;
    protected $basket = [];

    public function __construct(array $catalog, array $deliveryRules, array $offers)
    {
        $this->catalog = $catalog;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode)
    {
        if (!isset($this->catalog[$productCode])) {
            throw new \InvalidArgumentException("Product code {$productCode} not found.");
        }
        $this->basket[] = $productCode;
    }

    public function total(): array
    {
        $items = array_count_values($this->basket);
        $subtotal = 0.0;
        foreach ($items as $code => $qty) {
            $price = $this->catalog[$code]['price'] ?? 0.0;
            if ( in_array($code, $this->offers)) {
                $halfPriceItems = intdiv($qty, 2);
                $fullPriceItems = $qty - $halfPriceItems;
                $subtotal += ($fullPriceItems * $price) + ($halfPriceItems * ($price / 2));
                continue;
            }

            $subtotal += $qty * $price;
        }

        $delivery = 0.0;
        foreach ($this->deliveryRules as $rule) {
            if ($subtotal < $rule['threshold']) {
                $delivery = $rule['cost'];
                break;
            }
        }

        return [
            'subtotal' => $subtotal,
            'delivery' => $delivery
        ];
    }
}
