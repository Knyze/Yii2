<?php

use common\services\ProjectService;
use common\services\AssignRoleEvent;
use common\services\EmailService;
use common\services\NotificationService;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //'EmailService' => EmailService::className(),
        'projectService' => [
            'class' => ProjectService::className(),
            'on '.ProjectService::EVENT_ASSIGN_ROLE => function(AssignRoleEvent $event) {
                /*
                Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'AssignRole-html', 'text' => 'AssignRole-text'],
                        ['user' => $event->user, 'project' => $event->project, 'role' => $event->role]
                    )
                    ->setTo($event->user->email)
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    //->setReplyTo([$this->email => $this->name])
                    ->setSubject('Изменена роль в проекте')
                    //->setTextBody($this->body)
                    ->send();
                */
                //Yii::$app->EmailService->send($event->user->email, 'Изменена роль в проекте', ['html' => 'AssignRole-html', 'text' => 'AssignRole-text'], ['user' => $event->user, 'project' => $event->project, 'role' => $event->role]);
                $note = new NotificationService(new EmailService);
                $note->sendAboutNewProjectRole($event->user, $event->project, $event->role);
            }
        ],
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
    ],
];
