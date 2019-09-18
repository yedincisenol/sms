<?php

return [
    'default_driver' => 'EflatunSms',
    'Mutlucell' => [
        'request_endpoint' => 'https://smsgw.mutlucell.com/smsgw-ws/sndblkex',
        'username' => 'username',
        'password' => 'password',
    ],
    'EflatunSms' => [
        'request_endpoint' => 'http://panel.eflatunsms.com/httpapi/Send_Sms.aspx',
    ],
    'Iletimerkezi' => [
        'request_endpoint' => 'https://api.iletimerkezi.com/v1/send-sms/get/',
        'username' => 'username',
        'password' => 'password'
    ]
];
