<?php

use App\Livewire\Public\Cart;
use App\Livewire\Public\Home;
use App\Livewire\Public\Shop;
use App\Livewire\Public\Product;

use App\Livewire\Public\Checkout;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\CheckoutSuccess;
use App\Http\Middleware\PublicActivities;

Route::as('public.')->middleware([PublicActivities::class])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/product/{name}', Product::class)->name('product');
    Route::get('/shop', Shop::class)->name('shop');
    Route::get('/shop/checkout', Checkout::class)->name('checkout');
    Route::get('/order/checkout/{trackingNo}/view', CheckoutSuccess::class)->name('checkout.success');
    Route::get('/shop/cart', Cart::class)->name('cart');
});
