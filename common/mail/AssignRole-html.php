<?php

use yii\helpers\Html;

?>
<div>
    <p>Привет <?= Html::encode($user->username) ?></p>
    
    <p>В проекте <?= $project->title ?> тебе назначена роль <?= $role ?></p>
</div>