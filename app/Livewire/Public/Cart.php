<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Cart extends Component
{
    public $title = 'Cart';
    public $breadCrumb = 'Home.Cart';
    public $products = [];
    public $totalAmount = 0;
    public $default_currency;

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

        $this->default_currency = default_currency;

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
                $this->default_currency,
            );
        }
    }

    public function deleteItem($index)
    {
        if (isset($this->products[$index])) {
            unset($this->products[$index]);
            $products = [];

            $this->default_currency = default_currency;

            $totalAmount = 0;
            $exProducts = [];
            foreach ($this->products as $key => $vars) {
                $products[] = $vars;
                $exProducts[$vars['product']->id] = 1;
                $totalAmount += $vars['final'];
            }

            $this->totalAmount = currency_format(
                $totalAmount,
                $this->default_currency,
            );

            sharedProperty('add-to-cart', $products);
        }
    }

    public function render()
    {
        return view('livewire.public.cart')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
