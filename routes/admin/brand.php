<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Livewire\Admin\Brand\Brands;


Route::middleware([Authenticated::class])->prefix('admin/')->as('admin.')->group(function () {
    Route::get('/brands', Brands::class)->name('brands');
});
