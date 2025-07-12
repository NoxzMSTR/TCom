<?php
namespace App\Traits\Api;

use Illuminate\Support\Facades\Http;

trait SwitchTrait
{

    function checkout($parms = [])
    {
        $sUrl      = null;
        $sClientID = null;
        $sSecret   = null;

        if (defined('order_settings')) {
            foreach (order_settings as $key => $value) {

                if ($value['type'] == 'switch_landing_url') {
                    $sUrl = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                    $sUrl = $sUrl;
                }
                if ($value['type'] == 'switch_client_id') {

                    $sClient = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                    $sClientID = $sClient;
                }
                if ($value['type'] == 'switch_secret_key') {
                    $sSecret = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                    $sSecret = $sSecret;
                }
            }
        }

        if (! $sUrl || ! $sClientID || ! $sSecret) {
            return false;
        }

        $parms += ['clientid' => $sClient];

        $rawString = "Swich:{$parms['customerTransactionid']}:{$parms['item']}:{$parms['amount']}";
        $checksum  = hash_hmac('sha256', $rawString, $sSecret);

        $parms += ['checksum' => $checksum];

        $parms = http_build_query($parms);

        return $sUrl . '?' . $parms;
    }

}
