<?php

namespace App\Livewire\Public;

use App\Models\Brands;
use App\Models\Contacts;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Order\Orders;
use App\Models\Product\Products;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class Home extends Component
{
    public $title = 'Home';

    #[Renderless]
    #[On('newsletter-sign-up')]
    public function signUp($email)
    {
        $existed = Contacts::where('email', $email)->first();
        if (!$existed) {
            Contacts::create([
                'name' => '',
                'phone' => '',
                'subject' => 'Signed Up For News Letter',
                'message' => '',
                'email' => $email,
                'fromNewsLetter' => true,
            ]);
        }
    }

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
