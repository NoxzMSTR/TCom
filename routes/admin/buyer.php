<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Livewire\Admin\Buyer\BuyerDatatable;
use App\Livewire\Admin\Order\AddOrder;
use App\Livewire\Admin\Dashboard\Index;
use App\Livewire\Admin\Order\OrderDatatable;
use App\Livewire\Admin\Order\OrderSettings;
use App\Livewire\Admin\Product\AddProduct;
use App\Livewire\Admin\Product\Category;
use App\Livewire\Admin\Product\ProductDatatable;

Route::middleware([Authenticated::class])->prefix('admin/buyer')->as('admin.buyer.')->group(function () {
    Route::get('/list', [BuyerDatatable::class, 'view'])->name('list');
});
