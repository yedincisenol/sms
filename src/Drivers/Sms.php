<?php

namespace Mukellef\MukellefSms\Drivers;

use Mukellef\MukellefSms\Exceptions\DriverConfigurationException;

abstract class Sms
{
    protected $config;
    protected $httpClient;
    protected $requiredConfig;

    /**
     * Sms constructor.
     *
     * @param $driver
     * @param $config
     *
     * @throws DriverConfigurationException
     */
    public function __construct($driver, $config)
    {
        $this->httpClient = new \GuzzleHttp\Client();
        $defaultConfig = require __DIR__.'/../Config/Sms.php';
        $this->config = @$defaultConfig[$driver];
        $this->config = array_merge($this->config, $config);

        $this->validateConfig();
    }

    /**
     * @param $message
     * @param $numbers
     * @param $header
     * @param $valid_for
     *
     * @return mixed
     */
    abstract public function send($message, $numbers, $header, $valid_for);

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
