<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverConfigurationException;

abstract class Sms
{
    protected $config;
    protected $httpClient;
    protected $requiredConfig;

    public function __construct($driver, $config)
    {
        $this->httpClient = new \GuzzleHttp\Client();
        $this->config = require_once __DIR__.'/../Config/'.$driver.'.php';
        $this->config = array_merge($this->config, $config);

        $this->validateConfig();
    }

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @return mixed
     */
    abstract public function send($message, $numbers, $header);

    protected function validateConfig()
    {
        foreach ($this->requiredConfig as $required) {
            if (!array_key_exists($required, $this->config)) {
                throw new DriverConfigurationException($required.' config required for driver:'.get_class($this), 402);
            }
        }
    }

    abstract protected function checkResponse($response);
}
