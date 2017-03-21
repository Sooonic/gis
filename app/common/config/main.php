<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache', //TODO: Use memcached
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'cache' => 'cache',
            'defaultRoles' => ['route'],
        ],
    ],
];
