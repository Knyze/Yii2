<?php
namespace frontend\modules\api\controllers;


use yii\rest\Controller;
use frontend\modules\api\models\User;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
    //public $modelClass = User::class;
    
    public function actionIndex()
    {
        $dp = new ActiveDataProvider([
            'query' => User::find()
        ]);
        $dp->pagination->pageSize = 10;
        return $dp;
    }
    
    public function actionView($id)
    {
        return User::findOne($id);
    }
}