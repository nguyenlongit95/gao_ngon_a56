<?php

namespace App\Support;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ResponseQRCode
{
    // Size of qr-code
    const SIZE_CODE = 300;

    /**
     * Function encode by as utf-8
     *
     * @param string $key key of code
     * @param string $stringEndCode using end code here
     * @return string
     */
    public function encodedAsUTF8($key, $stringEndCode)
    {
        return QrCode::encoding('UTF-8')->generate($key . '-' . $stringEndCode);
    }

    /**
     * Function render qr-code default
     *
     * @param string $key key of code
     * @param string $stringEndCode using end code here
     * @return string
     */
    public function defaultQRCode($key, $stringEndCode)
    {
        return QrCode::size(self::SIZE_CODE)->generate($stringEndCode . '-' . $key);
    }

    /**
     * Function render and return image of qr-code
     *
     * @param string $key key of code
     * @param string $stringEndCode using end code here
     * @param string $image url of image
     * @return string|bool
     */
    public function encodeWithImage($key, $stringEndCode, $image)
    {
        // install package imagick extension
        return response(QrCode::format('png')->merge($image, 0.5, true)->size(self::SIZE_CODE)->errorCorrection('H')
            ->generate($stringEndCode . '-' . $key, public_path('qrCode/qrcode_' . $key . '.png')))
            ->header('Content-type','image/png');
    }

    /**
     * Function render qr-code using margin style
     *
     * @param string $key key of code
     * @param string $stringEndCode using end code here
     * @return mixed
     */
    public function encodeUsingMargin($key, $stringEndCode)
    {
        return QrCode::margin(10)->size(self::SIZE_CODE)->generate($stringEndCode . '-' . $key);
    }

    /**
     * Function render qr-code is color
     *
     * @param string $key key of code
     * @param string $stringEndCode using end code here
     * @param string $color name of color: green, red, blud, black, white
     * @return mixed
     */
    public function encodeIsColored($key, $stringEndCode, $color)
    {
        $colorRed = 0;
        $colorGreen = 0;
        $colorBlue = 0;
        switch ($color) {
            case 'red':
                $colorRed = 255;
                break;
            case 'green':
                $colorGreen = 255;
                break;
            case 'blue':
                $colorBlue = 255;
                break;
            case 'white':
                $colorRed = 255;
                $colorGreen = 255;
                $colorBlue = 255;
                break;
            default:
                break;
        }

        return QrCode::encoding('UTF-8')->size(self::SIZE_CODE)->backgroundColor($colorRed,$colorGreen,$colorBlue)
            ->generate($stringEndCode . '-' . $key);
    }

    /**
     * Function encode with sms using phone and message
     *
     * @param string $phone phone number
     * @param string $message content of message sms
     * @return mixed
     */
    public function encodeWithSMS($phone, $message)
    {
        return QrCode::SMS($phone, $message);
    }

    /**
     * Function encode with phone number
     *
     * @param string $phone phone number
     * @return mixed
     */
    public function encodeWithPhone($phone)
    {
        return QrCode::phoneNumber($phone);
    }

    /**
     * Function en qr-code with email
     *
     * @param string $to email to
     * @param string $subject of email
     * @param string $body body of email
     * @return mixed
     */
    public function encodeWithEmail($to, $subject, $body)
    {
        return QrCode::email($to, $subject, $body);
    }

    /**
     * Function render qr-code with global
     *
     * @param float $latitude location of global
     * @param float $longitude location of global
     * @return mixed
     */
    public function encodeWithGlobalLocation($latitude, $longitude)
    {
        return QrCode::geo($latitude, $longitude);
    }
}
