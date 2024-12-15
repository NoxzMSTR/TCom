<?php

use Illuminate\Support\Facades\Cache;

define('PRODUCT_STATUS', ['Draft', 'Published', 'OnHold', 'Disabled']);

define('PRODUCT_VARIATIONS', ['Color', 'Size', 'Material', 'Style']);

define('ORDER_PAYMENT_METHOD', ['cod' => 'Cash on delivery', 'credit' => 'Credit / Debit Card', 'bank' => 'Bank']);

define('BUYER_TYPE', [0 => 'Customer', 1 => 'Client']);

define('ORDER_PAID_STATUS', [0 => 'Not Paid', 1 => 'Paid']);

define('ORDER_STATUS', [0 => 'Pending', 1 => 'Collected', 2 => 'Delivered', 3 => 'Completed', 4 => 'Cancelled', 5 => 'Failed', 6 => 'Refunded']);


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
