<?php

namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class DataController extends Controller
{
    public function actionUsers() {
        $admin = new User([
            'username' => 'admin',
            //'password_hash' => '',
            //'auth_key' => '',
            'email' => 'admin@gb.ru',
            'access_token' => 'test',
            'created_at' => time(),
            //'updated_at' => time(),
        ]);
        
        $admin->generateAuthKey();
        $admin->password = 'admin';
        $admin->save();
    }
}