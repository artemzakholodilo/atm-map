<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'atmDefaultCity' => 'Днепропетровск',

    'rabbitMQ' => [
        'host' => 'rabbitmq',
        'port' => '5672',
        'username' => 'guest',
        'password' => 'guest',
        'defaultQueue' => 'atm',
        'autoDelete' => YII_DEBUG ?? true
    ]
];
