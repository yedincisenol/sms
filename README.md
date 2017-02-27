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

## Add new Providers

You can fork the repo and add new providers what you need.

### How?

- Add new file in Config folder same of Driver name
- Add new Driver in Drivers folder
 - Extend new Driver from Sms abstract class
 - Add Required config parameters array  and fill it
 - Add send method  and fill it
 - Add checkResponse method and fill it
 
 
Send me mail <o@yedincisenol.com> for any problem or help request.