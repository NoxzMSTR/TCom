<?php

use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard\Index;

Route::middleware([Authenticated::class])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
});
