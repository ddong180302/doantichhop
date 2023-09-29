<?php

namespace App\Helper;

class CartHelper
{
    public $products = null;
    public $total_quantity = 0;
    public $total_price = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->total_price = $cart->total_price;
            $this->total_quantity = $cart->total_quantity;
        }
    }

    public function addCart($product, $id)
    {
        $newProduct = ['quantity' => 0, 'price' => $product->product_price, 'productInfo' => $product];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        if ($newProduct['quantity'] < $product->product_quantity) {
            $newProduct['quantity']++;
            $newProduct['price'] = $newProduct['quantity'] *  $product->product_price;
            $newProduct['productInfo'] = $product;
            $this->products[$id] =  $newProduct;
            $this->total_price +=  $product->product_price;
            $this->total_quantity++;
        } else {
            return;
        }
    }

    public function DeleteItemCart($id)
    {
        $this->total_quantity -= $this->products[$id]['quantity'];
        $this->total_price -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }

    public function UpdateItemCart($id, $quantity)
    {
        $this->total_quantity -= $this->products[$id]['quantity'];
        $this->total_price -= $this->products[$id]['price'];

        $this->products[$id]['quantity'] = $quantity;
        $this->products[$id]['price'] = $quantity * $this->products[$id]['productInfo']->product_price;

        $this->total_quantity += $this->products[$id]['quantity'];
        $this->total_price += $this->products[$id]['price'];
    }
}
