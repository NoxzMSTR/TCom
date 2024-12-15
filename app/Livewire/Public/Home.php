<?php

namespace App\Livewire\Public;

use App\Models\Brands;
use App\Models\Order\Orders;
use App\Models\Product\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $title = 'Home';

    public function render()
    {
        $products = Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1)->orderBy('created_at', 'DESC')->limit(50)->get();

        $orders = Orders::with(['items.product.categories'])->orderBy('created_at', 'DESC')->limit(50)->get();

        $brands = Brands::get();

        return view('livewire.public.home', ['products' => $products, 'brands' => $brands, 'orders' => $orders])->extends('layout.public-master', ['title' => $this->title])->section('content');
    }
}
