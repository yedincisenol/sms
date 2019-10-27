<?php

namespace yedincisenol\Sms\Drivers;

use GuzzleHttp\Exception\RequestException;
use http\Client\Response;
use Psr\Http\Message\ResponseInterface;
use yedincisenol\Sms\Exceptions\DriverConfigurationException;

class Verimor extends Sms
{
    /**
     * @var array Required config fields
     */
    protected $requiredConfig = [
        'username', 'password'
    ];

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @return void
     * @throws \yedincisenol\Sms\Exceptions\DriverConfigurationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($message, $numbers, $header)
    {
        $this->validateConfig();
        try {
            $this->httpClient->request('POST', $this->config['request_endpoint'], [
                'json' => [
                    'username' => $this->config['username'],
                    'password' => $this->config['password'],
                    'source_addr' => $header,
                    'messages' => [
                        [
                            'msg' => $message,
                            'dest' => implode(',', $numbers)
                        ]
                    ]
                ]
            ]);
        } catch (RequestException $exception) {
            $this->checkResponse($exception->getCode());
        }
    }

    /**
     * @param $responseCode
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