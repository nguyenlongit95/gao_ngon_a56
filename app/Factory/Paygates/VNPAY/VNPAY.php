<?php

namespace App\Factory\Paygates\VNPAY;

class VNPAY
{
    /**
     * Function do direct payment and render vnp url
     *
     * @param array $inputData
     * @param string $vnp_Url
     * @param string $vnp_HashSecret
     * @return string
     */
    public function doDirectPayment($inputData, $vnp_Url, $vnp_HashSecret)
    {
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256',$vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    /**
     * Render secure has using inputData
     *
     * @param array $inputData
     * @param string $vnp_HashSecret
     * @param string $hashData
     * @return string
     */
    public function secureHash($inputData, $vnp_HashSecret, $hashData)
    {
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        return hash('sha256',$vnp_HashSecret . $hashData);
    }
}
