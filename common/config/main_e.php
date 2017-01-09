<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=db_minhdoan',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.elasticemail.com',
                'username' => '0df65482-3eb6-49b0-8fb2-be246ba02dbd',
                'password' => '0df65482-3eb6-49b0-8fb2-be246ba02dbd',
                'port' => '2525',
                'encryption' => 'tls',
            ],
        ],
    ],
];
