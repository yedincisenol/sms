<?php

include "vendor/autoload.php";


//$mutluCell = new yedincisenol\Sms\Sms('Mutlucell', []);
//$mutluCell->send('Selam', ['05459196661'], 'prstent.com');

/**
 * Example client for send sms with Eflatun Sms provider
 */
$smsProvider = new yedincisenol\Sms\Sms("EflatunSms", array(
    "username"  => "eflatun_sms_username",
    "password"  => "eflatun_sms_password"
));

echo $smsProvider->send("Selam", array(5557777777), "YENICO");