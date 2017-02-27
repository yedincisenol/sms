<?php

namespace yedincisenol\Sms;

use yedincisenol\Sms\Exceptions\DriverConfigurationException;
use yedincisenol\Sms\Exceptions\DriverNotFoundException;

class Sms
{

    private $driver;
    private $config;

    public function __construct($driver = false, $config = Array())
    {

        $this->config   =   require __DIR__ . "/Config/Sms.php";

        if($driver == false){

            $driver = $this->config['default_driver'];

        }

        try
        {
            $driverClass =  "\\yedincisenol\\Sms\\Drivers\\{$driver}";
            $this->driver = new $driverClass($driver, $config);

        }catch (DriverConfigurationException $e) {

            throw new DriverConfigurationException($e->getMessage());

        }catch (DriverNotFoundException $e)
        {
            throw new DriverConfigurationException("Driver not found: " . $driver);
        }
    }

    public function send($message, $numbers, $header)
    {
        $this->driver->send($message, $numbers, $header);
    }
}