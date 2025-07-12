<?php

use App\Models\Product\Products;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use OzdemirBurak\Iris\Color\Hex;

define('PRODUCT_STATUS', ['Draft', 'Published', 'OnHold', 'Disabled']);

define('PRODUCT_VARIATIONS', ['Color', 'Size', 'Material', 'Style', 'Piece']);

define('ORDER_PAYMENT_METHOD', ['cod' => 'Cash on delivery', 'credit' => 'Credit / Debit Card', 'bank' => 'Bank', 'advance' => 'Advance Payment + Cash on delivery']);

define('BUYER_TYPE', [0 => 'Customer', 1 => 'Client']);

define('ORDER_PAID_STATUS', [0 => 'Not Paid', 1 => 'Paid']);

define('ORDER_STATUS', [0 => 'Pending', 1 => 'Collected', 2 => 'Delivered', 3 => 'Completed', 4 => 'Cancelled', 5 => 'Failed', 6 => 'Refunded']);

function convertColor($hex, $type, $percent)
{
    $hexColor = new Hex($hex);
    if ($type == 'dark') {
        return $hexColor->darken($percent); // 20% darker
    }

    return $hexColor->lighten($percent); // 20% lighter

}

function sharedProperty($type, $property = [])
{
    $id = session()->getId();

    Cache::store('file')->put($type . '_' . $id, $property, now()->addMinutes(240));
}

function getSharedProperty($type)
{
    $id = session()->getId();

    return Cache::store('file')->get($type . '_' . $id);
}

function forgetSharedProperties($types = [])
{
    $id = session()->getId();
    if (is_array($types)) {
        foreach ($types as $key => $type) {
            Cache::store('file')->forget($type . '_' . $id);
        }
    }
}

function product($id)
{
    return Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1)->orderBy('created_at', 'DESC')->first();
}

function getIp()
{
    foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return request()->ip(); // it will return the server IP if the client IP is not found using this method.
}

function getCountry($ip)
{

    // Free IP geolocation API (ip-api.com)
    $url = "http://ip-api.com/json/{$ip}";

    // Use Guzzle to make the API request
    $client   = new Client();
    $response = $client->get($url);
    $data     = json_decode($response->getBody(), true);

    // Check if the country is available
    if ($data && isset($data['country'])) {
        return $data;
    } else {
        return false;
    }
}

function carbonDate($date, $format = 'Y-m-d H:i:s')
{
    if (isset($_COOKIE['user_timezone'])) {
        $localized = Carbon::parse($date, config('app.timezone'))->setTimezone(isset($_COOKIE['user_timezone']))->format($format);
    } else {
        $localized = Carbon::parse($date, config('app.timezone'))->format($format);
    }

    return $localized;
}
