<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
        'definitions' => [
            'common\services\ATMServiceInterface' => ['class' => 'common\services\PbAtmService'],
            'backend\services\TaskSender' => ['class' => 'backend\services\TaskSender']
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
