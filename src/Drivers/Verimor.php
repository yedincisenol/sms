<?php

namespace Mukellef\MukellefSms\Drivers;

use GuzzleHttp\Exception\RequestException;
use Mukellef\MukellefSms\Exceptions\DriverConfigurationException;

class Verimor extends Sms
{
    /**
     * @var array Required config fields
     */
    protected $requiredConfig = [
        'username', 'password',
    ];

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @throws \Mukellef\MukellefSms\Exceptions\DriverConfigurationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return void
     */
    public function send($message, $numbers, $header, $valid_for)
    {
        $this->validateConfig();

        try {
            $this->httpClient->request('POST', $this->config['request_endpoint'], [
                'json' => [
                    'username'    => $this->config['username'],
                    'password'    => $this->config['password'],
                    'source_addr' => $header,
                    'valid_for'   => '24:00',
                    'messages'    => [
                        [
                            'msg'  => $message,
                            'dest' => implode(',', $numbers),
                        ],
                    ],
                ],
            ]);
        } catch (RequestException $exception) {
            $this->checkResponse($exception->getCode());
        }
    }

    /**
     * @param $responseCode
     *
     * @throws DriverConfigurationException
     */
    protected function checkResponse($responseCode)
    {
        switch ($responseCode) {
            case 401:
                throw new DriverConfigurationException('User authentication failed, please check your credentials');
                break;
            default:
                throw new DriverConfigurationException();
                break;
        }
    }
}
