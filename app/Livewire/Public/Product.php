<?php
namespace App\Livewire\Public;

use App\Models\Product\Products;
use App\Models\Product\ProductVariations;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Product extends Component
{
    public $id;
    public $title;
    public $qty        = 1;
    public $final      = 0;
    public $variations = [];
    public $breadCrumb = 'Home.Product';

    public function mount($id, $name)
    {
        $this->id    = $id;
        $this->title = $name;
    }

    #[Renderless]
    public function addToCart()
    {
        $product = Products::with(['brand', 'categories', 'assets', 'variations', 'vendor', 'feedback', 'specification'])->where('id', $this->id)->first();

        $variations = [];

        foreach ($this->variations as $key => $value) {
            $variation        = ProductVariations::find($value);
            $variations[$key] = $variation;
        }

        $cart = ['product' => $product, 'qty' => $this->qty, 'variations' => $variations, 'final' => $this->final];

        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $products[] = $cart;

        sharedProperty('add-to-cart', $products);

        $this->dispatch('add-to-cart');
    }

    #[Renderless]
    public function buyNow()
    {
        $product = Products::with(['brand', 'categories', 'assets', 'variations', 'vendor', 'feedback', 'specification'])->where('id', $this->id)->first();

        $variations = [];

        foreach ($this->variations as $key => $value) {
            $variation        = ProductVariations::find($value);
            $variations[$key] = $variation;
        }

        $cart = ['product' => $product, 'qty' => $this->qty, 'variations' => $variations, 'final' => $this->final];

        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $products[] = $cart;

        sharedProperty('add-to-cart', $products);

        $this->dispatch('add-to-cart');

        $this->redirect(route('public.checkout'));
    }

    public function render()
    {
        $product = Products::with(['brand', 'categories', 'assets', 'variations', 'vendor', 'feedback', 'specification'])->where('id', $this->id)->where('status', 1)->where('qty', '!=', 0)->first();

        if (! $product) {
            return view('not-found')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
        }

        $hasActivity = Activity::whereJsonContains('properties->ip_address', request()->ip())->whereJsonContains('properties->session_id', request()->session()->getId())->whereJsonContains('properties->product_id', $product->id)->whereDate('created_at', now()->format('Y-m-d'))->where('log_name', 'product_click')->first();

        if (! $hasActivity) {
            activity('product_click') // Log name
                ->causedBy(null)          // Anonymous user
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