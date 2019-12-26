<?php

namespace common\services;


use yii\base\Component;
use common\models\User;
use common\models\Project;
use common\models\Task;
use common\models\ProjectUser;

class TaskService extends Component
{
    public function canManage(Project $project, User $user)
    {
        return \Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);
    }
    
    public function canTake(Task $task, User $user)
    {
        return \Yii::$app->projectService->hasRole($task->project, $user, ProjectUser::ROLE_DEVELOPER) &&
            empty($task->executor_id);
    }
    
    public function canComplete(Task $task, User $user)
    {
        return $task->executor_id === $user->id && empty($task->completed_at);
    }
        
    public function takeTask(Task $task, User $user)
    {
        $task->executor_id = $user->id;
        $task->started_at = time();
        return $task->save();
    }
    
    public function completeTask(Task $task)
    {
        $task->completed_at = time();
        return $task->save();
    }
    
}