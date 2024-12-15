<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product\Products;
use Livewire\WithoutUrlPagination;

class Shop extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $title = 'Shop';
    public $breadCrumb = 'Home.Shop';

    public function render()
    {
        $products = Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20, pageName: 'shop-page');

        return view('livewire.public.shop', ['products' => $products])->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
