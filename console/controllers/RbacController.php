<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        $user = $auth->createRole(User::ROLE_USER);
        $auth->add($user);
        
        $admin = $auth->createRole(User::ROLE_ADMIN);
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $auth->assign($admin, 1);
    }
}