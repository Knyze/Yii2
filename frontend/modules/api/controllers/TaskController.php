<?php
namespace frontend\modules\api\controllers;


use yii\rest\ActiveController;
use frontend\modules\api\models\Task;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;
}