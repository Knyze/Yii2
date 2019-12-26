<?php

namespace common\services;


class NotificationService extends \yii\base\Component
{
    protected $emailService;
    
    public function __construct(EmailServiceInterface $emailService, array $config = [])
    {
        parent::__construct($config);
        $this->emailService = $emailService;
    }
    
    public function sendAboutNewProjectRole($user, $project, $role)
    {
        $views = ['html' => 'AssignRole-html', 'text' => 'AssignRole-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];
        $this->emailService->send($user->email, 'Изменена роль в проекте', $views, $data);
    }
        
}