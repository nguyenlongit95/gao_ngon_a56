<?php

namespace App\Factory\Paygates\Paypal;

use App\Models\Paygate;
use Psy\Util\Json;

class PayPal
{
    const PAY_GATE = 'paypal';
    private $id;
    private $name;
    private $code;
    private $url;
    private $config;
    private $icon;

    /**
     * PayPal constructor.
     */
    public function __construct()
    {
    }

    /**
     * Function set id
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Function set name
     *
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Function set code
     *
     * @param $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Function set url
     *
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Function set config
     *
     * @param $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * Function set Icon
     *
     * @param $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Function get Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Function get Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Function get Code
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Function get Url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Function get Config
     *
     * @return mixed
     */
    public function getConfig()
    {
        return $this->getConfig();
    }

    /**
     * Function setter all attitude of pay gate
     *
     * @param int $id
     * @param string $name
     * @param string $code
     * @param string $url
     * @param Json $config
     * @param string $icon
     */
    public function setter($id, $name, $code, $url, $config, $icon)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->url = $url;
        $this->config = $config;
        $this->icon = $icon;
    }

    /**
     * Function get data from database
     *
     * @return mixed
     */
    public function getData()
    {
        return Paygate::where('code', self::PAY_GATE)->first();
    }
}
