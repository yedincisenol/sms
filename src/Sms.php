<?php

namespace yedincisenol\Sms;

use yedincisenol\Sms\Exceptions\DriverConfigurationException;
use yedincisenol\Sms\Exceptions\DriverNotFoundException;

class Sms
{
    private $driver;

    public function __construct($driver = false, $config = [])
    {
        if ($config === [] && function_exists('config')) {
            $smsConfig = config('sms');
        }

        if ($driver == false) {
            $driver = $smsConfig['default_driver'];
        }

        if ($config === [] && function_exists('config')) {
            $config = config('sms.'.$driver);
        }

        $this->driver($driver, $config);
    }

    public function driver($driver, $config)
    {
        try {
            $driverClass = "\\yedincisenol\\Sms\\Drivers\\{$driver}";
            $this->driver = new $driverClass($driver, $config);
        } catch (DriverConfigurationException $e) {
            throw new DriverConfigurationException($e->getMessage());
        } catch (DriverNotFoundException $e) {
            throw new DriverConfigurationException('Driver not found: '.$driver);
        }
    }

    /**
     * @param $message string
     * @param $numbers array
     * @param $header string  SMS HEADER
     */
    public function send($message, $numbers, $header)
    {
        $this->driver->send($message, $numbers, $header);
    }
}
