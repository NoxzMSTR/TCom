<?php

namespace App\Livewire\Public;

use App\Models\Product\Products;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

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
        $product = Products::with(['brand', 'categories', 'assets', 'variations', 'vendor', 'feedback', 'specification'])->where('name', $this->title)->first();

        $hasActivity = Activity::whereJsonContains('properties->ip_address', request()->ip())->whereJsonContains('properties->session_id', request()->session()->getId())->whereJsonContains('properties->product_id', $product->id)->whereDate('created_at', now()->format('Y-m-d'))->where('log_name', 'product_click')->first();

        if (! $hasActivity) {
            activity('product_click') // Log name
                ->causedBy(null) // Anonymous user
                ->withProperties([
                    'product_id' => $product->id,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                    'session_id' => request()->session()->getId(),
                ])
                ->log('Anonymous user clicked on a product');
        }

        return view('livewire.public.product', ['product' => $product])->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
