<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['encrypt' => 'multipart/form-data'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
                ],
        ]
    ); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?//= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?/*= $form->field($model, 'avatar')
        ->fileInput(['accept' => 'image/*'])
        ->label('Avatar' . Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW))) */?>
    <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*']) ?>
    <?= Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW), ['class' => 'col-lg-offset-2']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success col-lg-offset-4 col-lg-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
