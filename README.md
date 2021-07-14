# PHP Sms Client

Send Sms With Php & Laravel and Any sms provider

## Added Providers For Now
- Eflatun Sms
- Mutlucell
- Iletimerkezi
- Verimor

## Example Usage

```
<?php

include "vendor/autoload.php";

/**
 * Example client for send sms with Eflatun Sms provider
 */
$smsProvider = new Mukellef\Sms\Sms("EflatunSms", array(
    "username"  => "eflatun_sms_username",
    "password"  => "eflatun_sms_password"
));

echo $smsProvider->send("Selam", array(5557777777), "YENICO");

```


## How to install

```composer require mukellef/sms ```

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
    Mukellef\Sms\LaravelServiceProvider::class
],
``

### For Lumen
Open `bootstrap/app.php` add these lines to Service Providers section.

```
$app->register(\Mukellef\Sms\LaravelServiceProvider::class);
```

If you need `config_path` helper, [this](https://gist.github.com/mabasic/21d13eab12462e596120) can help you.

## Add new Providers

You can fork the repo and add new providers what you need.

### How?

- Add new Config key in `Config/Sms.php` file as same of Driver name
- Add new Driver in Drivers folder
 - Extend new Driver from Sms abstract class
 - Add Required config parameters array  and fill it
 - Add send method and fill it
 - Add checkResponse method and fill it

