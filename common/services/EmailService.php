<?php
namespace common\services;


class EmailService extends \yii\base\Component //implements EmailInterface
{
    public function send($to, $subject, $views, $data)
    {
        \Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }
    
}
