<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BasketService;
use App\Constants\Product;

class BasketController extends Controller
{
    public function showForm()
    {
        return view('basket',[
            'products' => Product::$catalog
        ]);
    }

    public function calculateTotal(Request $request)
    {
       

        $basket = new BasketService(Product::$catalog, Product::$deliveryRules, Product::$offers);

        $productCodes = $request->input('selectedProduct', []);
        foreach ($productCodes as $code) {
            $basket->add($code);
        }

        $cost = $basket->total();

        return view('basket', [
            'products' => Product::$catalog,
            'cost' => $cost,
            'selected' => $productCodes
        ]);
    }
}
