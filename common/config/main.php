<?php

use common\services\ProjectService;
use common\services\TaskService;
use common\services\AssignRoleEvent;
use common\services\NotificationService;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
        'definitions' => [
            \common\services\EmailServiceInterface::class => \common\services\EmailService::class,
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],
        'notificationService' => NotificationService::class,
        'projectService' => [
            'class' => ProjectService::className(),
            'on '.ProjectService::EVENT_ASSIGN_ROLE => function(AssignRoleEvent $event) {
                Yii::$app->notificationService->sendAboutNewProjectRole($event->user, $event->project, $event->role);
            }
        ],
        'taskService' => TaskService::class,
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@console/rbac/items.php',
            'assignmentFile' => '@console/rbac/assignments.php',
        ],
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
];
