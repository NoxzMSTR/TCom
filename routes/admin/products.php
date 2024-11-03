<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Livewire\Admin\Order\AddOrder;
use App\Livewire\Admin\Dashboard\Index;
use App\Livewire\Admin\Order\OrderDatatable;
use App\Livewire\Admin\Order\OrderSettings;
use App\Livewire\Admin\Product\AddProduct;
use App\Livewire\Admin\Product\Category;
use App\Livewire\Admin\Product\ProductDatatable;

Route::middleware([Authenticated::class])->prefix('admin/product')->as('admin.product.')->group(function () {
    Route::get('/add', AddProduct::class)->name('add');
    Route::get('{productID}/update', AddProduct::class)->name('update');
    Route::get('/list', [ProductDatatable::class, 'view'])->name('list');
    Route::get('/categories', Category::class)->name('categories');
});
