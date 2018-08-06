<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverSmsSendFailException;

class EflatunSms extends Sms
{
    protected $requiredConfig = [
        'username', 'password',
    ];

    public function send($message, $numbers, $header)
    {
        $response = $this->httpClient->request('GET', $this->config['request_endpoint'], [
            'query'   => [
                'username'  => $this->config['username'],
                'password'  => $this->config['password'],
                'alfa'      => $header,
                'message'   => $message,
                'numbers'   => implode(',', $numbers),
            ], ]);

        $this->checkResponse($response);
    }

    /**
     * @param $response
     *
     * @throws DriverSmsSendFailException
     *
     * @return bool
     */
    protected function checkResponse($response)
    {
        if ($response->getStatusCode() != 200 || strpos($response->getBody(), 'OK|') !== 0) {
            throw new DriverSmsSendFailException('Sms send failed:'.$response->getBody());
        }

        return true;
    }
}
