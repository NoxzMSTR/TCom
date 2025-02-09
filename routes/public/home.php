<?php

use App\Livewire\Public\Cart;
use App\Livewire\Public\Home;
use App\Livewire\Public\Shop;
use App\Livewire\Public\Product;

use App\Livewire\Public\Checkout;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\CheckoutSuccess;
use App\Http\Middleware\PublicActivities;
use App\Livewire\Public\AboutUs;
use App\Livewire\Public\ContactUs;
use App\Livewire\Public\PrivacyPolicy;
use App\Livewire\Public\RefundPolicy;
use App\Livewire\Public\TermsConditions;

Route::as('public.')->middleware([PublicActivities::class])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/product/{id}/{name}', Product::class)->name('product');
    Route::get('/shop', Shop::class)->name('shop');
    Route::get('/shop/checkout', Checkout::class)->name('checkout');
    Route::get('/order/checkout/{trackingNo}/view', CheckoutSuccess::class)->name('checkout.success');
    Route::get('/shop/cart', Cart::class)->name('cart');
    Route::get('/about-us', AboutUs::class)->name('about-us');
    Route::get('/contact-us', ContactUs::class)->name('contact-us');
    Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
    Route::get('/refund-policy', RefundPolicy::class)->name('refund-policy');
    Route::get('/terms-&-conditions', TermsConditions::class)->name('terms-n-conditions');
});
