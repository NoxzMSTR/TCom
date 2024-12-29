<?php

namespace App\Livewire\Public\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Product\Products;
use Illuminate\Support\Facades\Log;

class GlobalCart extends Component
{
    public $placement;

    public $total = 0;

    public $totalAmount = 0;

    public $addToCart = [];

    public $products = [];

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

        $this->products = $products;

        $default_currency = default_currency;
        if (is_array($products)) {

            $totalAmount = 0;
            $exProducts = [];
            foreach ($products as $key => $product) {
                $exProducts[$product->id] = 1;
                if (isset($default_currency)) {
                    $discount = 0;
                    $amount = $product->amount;
                    if ($product->discountType == 1) {
                        $discount =
                            ($amount / 100) * $product->discountData;
                        $totalAmount +=  $discount = $amount - $discount;
                    } elseif ($product->discountType == 2) {
                        $totalAmount += $discount = $product->discountData;
                    } else {
                        $totalAmount += $discount = $product->amount;
                    }
                } else {
                    $totalAmount += $discount = $product->amount;
                }
            }

            $this->total = count($exProducts);
            $this->totalAmount = currency_format(
                $totalAmount,
                $default_currency,
            );
        }
    }

    #[On('add-to-cart')]
    public function addToCart($product)
    {

        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $products[] = Products::find($product);

        sharedProperty('add-to-cart', $products);

        $this->products = $products;

        $default_currency = default_currency;
        if (is_array($products)) {

            $totalAmount = 0;
            $exProducts = [];
            foreach ($products as $key => $product) {
                $exProducts[$product->id] = 1;
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
            $this->total = count($exProducts);
            $this->totalAmount = currency_format(
                $totalAmount,
                $default_currency,
            );
        }
    }

    #[On('remove-from-to-cart')]
    public function removeFromCart($productID)
    {

        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $exProducts = [];

        foreach ($products as $key => $product) {
            if ($product->id !== $productID) {
                $exProducts[] = $product;
            }
        }

        sharedProperty('add-to-cart', $exProducts);

        $this->init();
    }

    public function render()
    {
        return view('livewire.public.cart.global-cart');
    }
}
