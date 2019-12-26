<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['encrypt' => 'multipart/form-data'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
                ],
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'project_id')->textInput() ?>
    
    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <?//= $form->field($model, 'executor_id')->textInput() ?>

    <?//= $form->field($model, 'started_at')->textInput() ?>

    <?//= $form->field($model, 'completed_at')->textInput() ?>

    <?//= $form->field($model, 'creator_id')->textInput() ?>

    <?//= $form->field($model, 'updater_id')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success col-lg-offset-4 col-lg-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
