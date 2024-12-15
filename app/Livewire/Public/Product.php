<?php

namespace App\Livewire\Public;

use App\Models\Product\Products;
use Livewire\Component;

class Product extends Component
{
    public $title;
    public $breadCrumb = 'Home.Product';

    public function mount($name)
    {
        $this->title = $name;
    }

    public function render()
    {
        $product = Products::with(['brand', 'categories', 'assets', 'variations', 'vendor', 'feedback'])->where('name', $this->title)->first();

        return view('livewire.public.product', ['product' => $product])->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
