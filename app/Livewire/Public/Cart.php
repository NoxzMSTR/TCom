<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Cart extends Component
{
    public $title = 'Cart';
    public $breadCrumb = 'Home.Cart';
    public $products = [];
    public $totalAmount = 0;

    public function mount()
    {
        $this->init();
    }

    public function init()
    {
        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $default_currency = default_currency;

        if (is_array($products)) {

            $totalAmount = 0;

            $exProduct = [];

            foreach ($products as $key => $product) {
                $exProduct[$product->id][] = $product;
                if (isset($default_currency)) {
                    $discount = 0;
                    $amount = $product->amount;
                    if ($product->discountType == 1) {
                        $discount =
                            ($amount / 100) * $product->discountData;
                        $totalAmount +=  $discount = $amount - $discount;
                    } elseif ($product->discountType == 2) {
                        $totalAmount += $discount = $product->discountData;
                    }
                } else {
                    $discount = $product->amount;
                }
            }

            $this->products = $exProduct;

            $this->totalAmount = currency_format(
                $totalAmount,
                $default_currency,
            );
        }
    }

    public function render()
    {
        return view('livewire.public.cart')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
