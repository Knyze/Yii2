<?php
namespace common\services;


class EmailService extends \yii\base\Component implements EmailServiceInterface
{
    public function send($to, $subject, $views, $data)
    {
        return \Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }
    
}
