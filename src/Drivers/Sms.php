<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverConfigurationException;

abstract class Sms
{

    protected $config;
    protected $httpClient;
    protected $requiredConfig;

    function __construct($driver, $config){

        $this->httpClient   =   new \GuzzleHttp\Client();
        $defaultConfig      =   require(__DIR__ . '/../Config/Sms.php');
        $this->config       =   @$defaultConfig[$driver];
        $this->config       =   array_merge($this->config, $config);

        $this->validateConfig();
    }

    /**
     * @param $message
     * @param $numbers
     * @param $header
     * @return mixed
     */
    abstract function send($message, $numbers, $header);

    protected function validateConfig(){

        foreach ($this->requiredConfig as $required)
        {
            if(!key_exists($required, $this->config))
            {
                throw new DriverConfigurationException($required. " config required for driver:" . get_class($this), 402);
            }
        }
    }

    abstract protected function checkResponse($response);
}