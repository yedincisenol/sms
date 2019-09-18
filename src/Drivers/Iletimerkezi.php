<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverSmsSendFailException;

class Iletimerkezi extends Sms
{
    protected $requiredConfig = ['username', 'password'];

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @throws DriverSmsSendFailException
     *
     * @return mixed
     */
    public function send($message, $numbers, $header)
    {
        $this->validateConfig();

        try {
            $response = $this->httpClient->request('GET', $this->config['request_endpoint'], [
                'query'   => [
                    'receipents' => implode(',', $numbers),
                    'password'   => $this->config['password'],
                    'username'   => $this->config['username'],
                    'sender'     => $header,
                    'text'       => urlencode($message),
                ], ]);
        } catch (\Exception $e) {
            throw new DriverSmsSendFailException($e->getMessage(), $e->getCode());
        }
    }

    protected function checkResponse($response)
    {
    }
}
