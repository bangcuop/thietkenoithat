<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=thietkenoithat_db',
            'username' => 'thietkenoithat',
            'password' => '123456',
//            'dsn' => 'mysql:host=192.168.55.42;dbname=noitha17_minhdoan',
//            'username' => 'noitha17_minhdoan',
//            'password' => '123456',
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