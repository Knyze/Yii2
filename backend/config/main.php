<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'layout' => 'admin-lte/main',
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'on '.\yii\web\User::EVENT_AFTER_LOGIN => function($event) {
                Yii::info("Success login with id {$event->identity->getId()}", 'auth');
            },
            'on '.\yii\web\User::EVENT_BEFORE_LOGOUT => function($event) {
                Yii::info("Success logout with id {$event->identity->getId()}", 'auth');
            },
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['auth'],
                    'logFile' => '@runtime/logs/auth.log',
                    'logVars' => [],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'projects' => 'project/index',
                'project/<id:\d+>' => 'project/view',
                'project/update/<id:\d+>' => 'project/update',
                'users' => 'user/index',
                'user/<id:\d+>' => 'user/view',
                'user/update/<id:\d+>' => 'user/update',
            ],
        ],
        
    ],
    'params' => $params,
];
