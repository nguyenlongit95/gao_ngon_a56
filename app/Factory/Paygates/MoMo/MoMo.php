<?php

namespace App\Factory\Paygates\MoMo;

use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class MoMo
{
    /**
     * Function render and exec request
     *
     * @param string $url
     * @param Json $data
     * @return bool|string
     */
    function execPostRequest($url, $data)
    {
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }
}
