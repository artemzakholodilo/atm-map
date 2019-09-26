<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'atmDefaultCity' => 'Днепропетровск',

    'rabbitMQ' => [
        'host' => '127.0.0.1',
        'port' => '5632',
        'username' => 'guest',
        'password' => 'guest',
        'defaultQueue' => 'atm'
    ]
];
