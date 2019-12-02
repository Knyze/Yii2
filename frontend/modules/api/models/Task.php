<?php
namespace frontend\modules\api\models;


class Task extends \common\models\Task
{
    public function fields()
    {
        return [
            'id' => 'project_id',
            'title' => 'title',
            'description_short' => function($model) {
                return substr($model->description, 0, 50);
            },
        ];
    }
    
    public function extrafields()
    {
        return [
            'project',
        ];
    }
    
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }
}