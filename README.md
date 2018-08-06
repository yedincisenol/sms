# PHP Sms Client

Send Sms With Php & Laravel and Any sms provider

[![Travis](https://img.shields.io/travis/yedincisenol/sms.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/dt/yedincisenol/sms.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/v/yedincisenol/sms.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/l/yedincisenol/sms?style=for-the-badge)]()

## Added Providers For Now
- Eflatun Sms
- Mutlucell

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

## Config

You can fill `Sms` config file or pass config on initialize Sms object

### For Laravel

```
php artisan vendor:publish --tag=sms
```

For before Laravel 5.6

in `config/app.php`
`` 
providers' => [
	...
    yedincisenol\Sms\LaravelServiceProvider::class
],
``


## Add new Providers

You can fork the repo and add new providers what you need.

### How?

- Add new file in Config key in Config/Sms.php file, same of Driver name
- Add new Driver in Drivers folder
 - Extend new Driver from Sms abstract class
 - Add Required config parameters array  and fill it
 - Add send method  and fill it
 - Add checkResponse method and fill it
 
 
Send me mail <o@yedincisenol.com> for any problem or help request.
