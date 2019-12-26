<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('statusTask')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('statusTask') ?>
        </div>
    <?php endif?>
    
    <?php if ($canManage): ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'task_id',
            [
                'label' => 'Project',
                'attribute' => 'project_id',
                'value' => $model->project->title,
            ],
            'title',
            'description:ntext',
            [
                'label' => 'executor',
                'attribute' => 'executor_id',
                'value' => $model->executor->username,
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'label' => 'creator',
                'attribute' => 'creator_id',
                'value' => $model->creator->username,
            ],
            [
                'label' => 'updater',
                'attribute' => 'updater_id',
                'value' => $model->updater->username,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    
    <?php echo \yii2mod\comments\widgets\Comment::widget([
    // https://github.com/yii2mod/yii2-comments
        'model' => $model,
        'entityIdAttribute' => 'task_id',
    ]); ?>

</div>
