<?php

use yii\helpers\Html;

?>
Привет <?= Html::encode($user->username) ?>
    
В проекте <?= $project->title ?> тебе назначена роль <?= $role ?>