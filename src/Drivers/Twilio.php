<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverSmsSendFailException;

class Twilio extends Sms
{
    protected $requiredConfig = ['account_sid', 'auth_token', 'from_number'];

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @throws DriverSmsSendFailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return void
     */
    public function send($message, $numbers, $header)
    {
        $endpoint = 'https://api.twilio.com/2010-04-01/Accounts/'
            . $this->config['account_sid'] . '/Messages.json';

        foreach ($numbers as $number) {
            $response = $this->httpClient->request('POST', $endpoint, [
                'auth' => [
                    $this->config['account_sid'],
                    $this->config['auth_token'],
                ],
                'form_params' => [
                    'To' => $number,
                    'From' => $this->config['from_number'],
                    'Body' => $message,
                ],
            ]);

            $this->checkResponse($response);
        }
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
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 400) {
            $body = json_decode((string) $response->getBody(), true);
            $errorMessage = $body['message'] ?? 'Unknown Twilio error';
            throw new DriverSmsSendFailException(
                'Twilio SMS failed: ' . $errorMessage,
                $statusCode
            );
        }

        return true;
    }
}
