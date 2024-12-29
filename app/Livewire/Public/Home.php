<?php

namespace App\Livewire\Public;

use App\Models\Brands;
use Livewire\Component;
use App\Models\Order\Orders;
use App\Models\Product\Products;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class Home extends Component
{
    public $title = 'Home';

    public function render()
    {
        $products = Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1)->orderBy('created_at', 'DESC')->limit(50)->get();

        $orders = Orders::with(['items.product.categories'])->orderBy('created_at', 'DESC')->limit(50)->get();

        $brands = Brands::get();

        $hasRecentProducts = Activity::whereDate('created_at', now()->format('Y-m-d'))->where('log_name', 'product_click')->get();

        $hasProductID = [];

        foreach ($hasRecentProducts as $key => $value) {
            $props = $value->properties;
            $hasProductID[$props['product_id']] = $props['product_id'];
        }

        $recentProducts = Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1)->orderBy('created_at', 'DESC')->whereIn('id', $hasProductID)->limit(15)->get();

        return view('livewire.public.home', ['products' => $products, 'brands' => $brands, 'orders' => $orders, 'recentProducts' => $recentProducts])->extends('layout.public-master', ['title' => $this->title])->section('content');
    }
}
