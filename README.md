# sms

Send Sms With Php and Any sms provider

## Added Providers For Now
- Eflatun Sms

## Example Usage

```
<?php

include "vendor/autoload.php";

/**
 * Example client for send sms with Eflatun Sms provider
 */
$smsProvider = new yedincisenol\Sms\Sms("EflatunSms", array(
    "username"  => "eflatun_sms_username",
    "password"  => "eflatun_sms_password"
));

echo $smsProvider->send("Selam", array(5557777777), "YENICO");

```

## How to install

```composer require yedincisenol/sms ```
