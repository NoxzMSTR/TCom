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
use App\Livewire\Admin\Vendor\VendorDatatable;

Route::middleware([Authenticated::class])->prefix('admin/vendor')->as('admin.vendor.')->group(function () {
    Route::get('/list', [VendorDatatable::class, 'view'])->name('list');
});
