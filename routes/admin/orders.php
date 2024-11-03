<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Livewire\Admin\Order\AddOrder;
use App\Livewire\Admin\Dashboard\Index;
use App\Livewire\Admin\Order\OrderDatatable;
use App\Livewire\Admin\Order\OrderSettings;

Route::middleware([Authenticated::class])->prefix('admin/order')->as('admin.order.')->group(function () {
    Route::get('/add', AddOrder::class)->name('add');
    Route::get('{orderID}/update', AddOrder::class)->name('update');
    Route::get('/list', [OrderDatatable::class, 'view'])->name('list');
    Route::get('/settings', OrderSettings::class)->name('settings');
});
