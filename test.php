<?php

include 'vendor/autoload.php';

/**
 * Example request for Mutlucell.
 */
$mutluCell = new yedincisenol\Sms\Sms('Mutlucell', []);
//$mutluCell->send('Selam', ['05459196661'], 'prstent.com');

/**
 * Example client for send sms with Eflatun Sms provider.
 */
$smsProvider = new yedincisenol\Sms\Sms('EflatunSms', [
    'username'  => 'eflatun_sms_username',
    'password'  => 'eflatun_sms_password',
]);

//echo $smsProvider->send('Selam', [5557777777], 'YENICO');

/**
 * Example request for Iletimerkezi.
 */
$iletimerkezi = new yedincisenol\Sms\Sms('Iletimerkezi', []);
//$iletimerkezi->send('Selam', ['05459196661'], 'HEADER');

$verimor = new \yedincisenol\Sms\Sms('Verimor', [
    'username' => 'username',
    'password' => 'password'
]);

$verimor->send('Selam', ['00905459196661'], 'HEADER');