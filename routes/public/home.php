<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Public\Home;

Route::as('public.')->group(function () {
    Route::get('/', Home::class)->name('home');
});
