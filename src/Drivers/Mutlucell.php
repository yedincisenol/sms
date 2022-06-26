<?php

namespace yedincisenol\Sms\Drivers;

use yedincisenol\Sms\Exceptions\DriverSmsSendFailException;

class Mutlucell extends Sms
{
    protected $requiredConfig = ['username', 'password'];

    /**
     * @param $message
     * @param $numbers
     * @param $header
     *
     * @throws DriverSmsSendFailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function send($message, $numbers, $header)
    {
        $message = preg_replace('/[^A-Za-z0-9-ıİüÜçÇşŞğĞöÖ. \/\-\s+]/', '', $message);
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><smspack></smspack>');
        $xml->addAttribute('ka', $this->config['username']);
        $xml->addAttribute('pwd', $this->config['password']);
        $xml->addAttribute('org', $header);

        $child = $xml->addChild('mesaj');
        $child->addChild('metin', $message);
        $child->addChild('nums', implode(',', $numbers));

        $response = $this->httpClient->request('POST', $this->config['request_endpoint'], [
            'headers'   => [
                'content_type'  => 'text/xml',
            ],
            'body'  => $xml->asXML(),
        ]);

        return $this->checkResponse($response);
    }

    protected function checkResponse($response)
    {
        $errorCode = (string) $response->getBody();
        switch ($errorCode) {
            case '20':
                throw new DriverSmsSendFailException('Post edilen xml eksik veya hatalı.');
                break;
            case '21':
                throw new DriverSmsSendFailException('Kullanılan originatöre sahip değilsiniz');
                break;
            case '22':
                throw new DriverSmsSendFailException('Kontörünüz yetersiz');
                break;
            case '23':
                throw new DriverSmsSendFailException('Kullanıcı adı ya da parolanız hatalı.');
                break;
            case '24':
                throw new DriverSmsSendFailException('Şu anda size ait başka bir işlem aktif.');
                break;
            case '25':
                throw new DriverSmsSendFailException('SMSC Stopped (Bu hatayı alırsanız, işlemi 1-2 dk sonra tekrar deneyin)');
                break;
            case '30':
                throw new DriverSmsSendFailException(' Hesap Aktivasyonu sağlanmamış');
                break;
        }

        return true;
    }
}
