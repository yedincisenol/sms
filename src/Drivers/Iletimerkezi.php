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
     * @return mixed
     * @throws DriverSmsSendFailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \yedincisenol\Sms\Exceptions\DriverConfigurationException
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
                    'text'       => $message,
                ], ]);
        } catch (\Exception $e) {
             $this->checkResponse($e->getResponse());
        }
    }

    /**
     * @param $response
     * @throws DriverSmsSendFailException
     */
    protected function checkResponse($response)
    {
        $xml = simplexml_load_string((string) $response->getBody(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        throw new DriverSmsSendFailException($array['status']['message'], $array['status']['code']);
    }
}
