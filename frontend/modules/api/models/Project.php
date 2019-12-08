<?php
namespace frontend\modules\api\models;


class Project extends \common\models\Project
{
    public function fields()
    {
        return [
            'id' => 'project_id',
            'title',
            'description_short' => function($model) {
                return substr($model->description, 0, 50);
            },
            'active',
        ];
    }
    
    public function extrafields()
    {
        return [
            'tasks',
        ];
    }
    
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'project_id']);
    }
}