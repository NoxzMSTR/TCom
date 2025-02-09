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

            $this->products = $products;

            $totalAmount = 0;
            $exProducts = [];
            foreach ($products as $key => $vars) {
                $exProducts[$vars['product']->id] = 1;
                $totalAmount += $vars['final'];
            }

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
