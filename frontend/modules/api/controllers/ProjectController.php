<?php
namespace frontend\modules\api\controllers;


use yii\rest\ActiveController;
use frontend\modules\api\models\Project;

class ProjectController extends ActiveController
{
    public $modelClass = Project::class;
}