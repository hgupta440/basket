<?php

namespace App\Constants;
class Product
{
    public static $catalog = [
            'R01' => [
                'name' => 'Red Widget',
                'price' => 32.95,
            ],
            'G01' => [
                'name' => 'Green Widget',
                'price' => 24.95,
            ],
            'B01' => [
                'name' => 'Blue Widget',
                'price' => 7.95,
            ],
        ];

        public static $deliveryRules = [
            ['threshold' => 50.00, 'cost' => 4.95],
            ['threshold' => 90.00, 'cost' => 2.95],
            ['threshold' => INF, 'cost' => 0.00],
        ];

        public static $offers = [
            'R01'
        ];
}