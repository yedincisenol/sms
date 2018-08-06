<?php

namespace yedincisenol\Sms\Exceptions;

use Exception;

class DriverNotFoundException extends \Exception
{
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
