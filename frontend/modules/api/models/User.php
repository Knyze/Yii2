<?php
namespace frontend\modules\api\models;


class User extends \common\models\User
{
    
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'avatar',
        ];
    }
    
    
    public function extrafields()
    {
        return [
            'actived_tasks' => 'activedTasks',
            'created_tasks' => 'createdTasks',
            'updated_tasks' => 'updatedTasks',
            'created_projects' => 'createdProjects',
            'updated_projects' => 'updatedProjects',
        ];
    }
    
    public function getActivedTasks()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }
    
    public function getCreatedTasks()
    {
        return $this->hasMany(Task::className(), ['creator_id' => 'id']);
    }
    
    public function getUpdatedTasks()
    {
        return $this->hasMany(Task::className(), ['updater_id' => 'id']);
    }
    
    public function getCreatedProjects()
    {
        return $this->hasMany(Project::className(), ['creator_id' => 'id']);
    }
    
    public function getUpdatedProjects()
    {
        return $this->hasMany(Project::className(), ['updater_id' => 'id']);
    }
    
}