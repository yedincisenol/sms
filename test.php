<?php

include 'vendor/autoload.php';

/**
 * Example client for send sms with Eflatun Sms provider.
 */
$smsProvider = new yedincisenol\Sms\Sms('EflatunSms', [
    'username'  => 'eflatun_sms_username',
    'password'  => 'eflatun_sms_password',
]);

echo $smsProvider->send('Selam', [5557777777], 'YENICO');
