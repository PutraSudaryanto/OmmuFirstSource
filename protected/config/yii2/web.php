<?php
Yii::setAlias('@webroot', realpath(__DIR__ . '/../../../'));
Yii::setAlias('@app', '@webroot/protected');
Yii::setAlias('@config', '@app/config');
Yii::setAlias('@modules', '@app/modules');
Yii::setAlias('@themes', '@webroot/themes');
Yii::setAlias('@public', '@webroot/public');

$params = require(__DIR__ . '/params.php');
$database = ($_SERVER["SERVER_ADDR"]=='127.0.0.1' || $_SERVER["HTTP_HOST"]=='localhost') ? require(__DIR__ . '/database-dev.php') : require(__DIR__ . '/database.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(dirname(dirname(__DIR__))),
    'name' => 'RXK Indonesia',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
    ],
    'params' => $params,
];

$config = yii\helpers\ArrayHelper::merge(
    $config, 
    $database
);

if (YII_ENV_DEV) {
}
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    //$config['bootstrap'][] = 'gii';
    $config['modules']['gii2'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

return $config;
