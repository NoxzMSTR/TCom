<?php

namespace App\Providers;

use App\Models\Settings\System;
use App\Models\Order\OrderSettings;
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
            if (!defined('system_config')) {
                define('system_config', $system);
            }
            config(['system' => $system]);
        }
        if (Schema::hasTable('order_settings')) {
            $orderSettings = OrderSettings::get()->toArray();
            if (!defined('order_settings')) {
                define('order_settings', $orderSettings);
            }
            foreach ($orderSettings as $key => $value) {
                if ($value['type'] == 'default_currency') {
                    $currency = json_validate($value['data']) ? json_decode($value['data'])[0] : 'PKR';
                    if (!defined('default_currency')) {
                        define('default_currency', $currency);
                        $symbol = isset(currency()->getCurrencies()[$currency])
                            ? currency()->getCurrencies()[$currency]['symbol']
                            : '-';
                        define('default_currency_symbol', $symbol);
                    }
                }
            }
        }
    }
}
