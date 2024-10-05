<?php

use App\Http\Middleware\NotAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Authentication\Index;

Route::middleware([NotAuthenticated::class])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/login', Index::class)->name('login');
});

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/logout', [Index::class, 'logout'])->name('logout');
});
