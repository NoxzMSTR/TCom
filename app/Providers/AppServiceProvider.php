<?php

namespace App\Providers;

use App\Models\Settings\System;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('systems')) {
            $system = System::get()->keyBy('key');
            config(['system' => $system]);
        }
    }
}
