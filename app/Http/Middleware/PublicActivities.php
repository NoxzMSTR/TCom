<?php
namespace App\Http\Middleware;

use App\Models\Order\OrderSettings;
use App\Models\Product\Categories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as viewMang;
use Symfony\Component\HttpFoundation\Response;

class PublicActivities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $categories = Categories::with(['descendants'])->get()->toArray();

        viewMang::share('categories', $categories);

        $orderSettings = OrderSettings::get()->toArray();

        foreach ($orderSettings as $key => $value) {
            if ($value['type'] == 'default_currency') {
                $currency = json_validate($value['data']) ? json_decode($value['data'])[0] : 'PKR';
                if (! defined('default_currency')) {
                    define('default_currency', $currency);
                }
                viewMang::share('default_currency', $currency);
            }
        }

        viewMang::share('orderSettings', $orderSettings);

        if (isset($_COOKIE['user_timezone'])) {
            config(['app.timezone' => $_COOKIE['user_timezone']]);
            date_default_timezone_set($_COOKIE['user_timezone']);
        }

        return $next($request);
    }
}
