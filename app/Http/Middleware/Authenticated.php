<?php
namespace App\Http\Middleware;

use App\Models\Order\OrderSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as viewMang;
use Symfony\Component\HttpFoundation\Response;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user) {
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
                if (! defined('order_settings')) {
                    define('order_settings', $orderSettings);
                }
                viewMang::share('orderSettings', $orderSettings);

                return $next($request);
            } else {
                return redirect()->route('admin.login');
            }
        } else {
            return redirect()->route('admin.login');
        }
    }
}