<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \gis\yii\web\Response::FORMAT_JSON,
                'application/xml' => \gis\yii\web\Response::FORMAT_XML,
            ],
        ],
    ],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'response' => [
            'class' => 'gis\yii\web\Response',
        ],
        'errorHandler' => [
            'class' => 'gis\yii\rest\RESTErrorHandler',
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'gis\yii\user\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
