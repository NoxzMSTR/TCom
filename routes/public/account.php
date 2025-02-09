<?php

use App\Livewire\Public\Cart;
use App\Livewire\Public\Home;
use App\Livewire\Public\Shop;
use App\Livewire\Public\Login;

use App\Livewire\Public\AboutUs;
use App\Livewire\Public\Account;
use App\Livewire\Public\Product;
use App\Livewire\Public\Checkout;
use App\Livewire\Public\ContactUs;
use App\Livewire\Public\RefundPolicy;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\PrivacyPolicy;
use App\Livewire\Public\CheckoutSuccess;
use App\Livewire\Public\TermsConditions;
use App\Http\Middleware\PublicActivities;
use App\Http\Middleware\PublicAuthenticated;

Route::as('public.')->middleware([PublicAuthenticated::class, PublicActivities::class])->group(function () {
    Route::get('/my-account', Account::class)->name('account');
    Route::get('/my-orders', [Account::class, 'orders'])->name('orders');
});

Route::as('public.')->middleware([PublicActivities::class])->group(function () {
    Route::get('/login', [Login::class, 'auth'])->name('login');
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
});
