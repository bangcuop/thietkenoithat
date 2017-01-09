<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => !YII_DEBUG,
            'base_path' => '/home/noitha17/public_html',
            'minify_path' => '/home/noitha17/public_html/assets',
            'js_position' => [\yii\web\View::POS_END],
            'force_charset' => 'UTF-8',
            'expand_imports' => true,
        ],
        'request' => [
            'cookieValidationKey' => '8k1y4XezFg2PktNFsn4rlktz6eOiYBdd',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'frontend\models\data\Auth',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/signin'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/500',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false
            ],
        ],
        'urlManager' => require(__DIR__ . '/urlManager.php'),
    ],
    'params' => $params,
];

if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
}

return $config;