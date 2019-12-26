<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'project_id',
            'title',
            'description:ntext',
            [
                'attribute' => 'active',
                'value' => function($model) {
                    return \common\models\Project::STATUSES_LABELS[$model->active];
                }
            ],
            [
                'label' => 'Creator',
                'attribute' => 'creator_id',
                'value' => $model->creator->username,
            ],
            [
                'label' => 'Updater',
                'attribute' => 'updater_id',
                'value' => $model->updater->username,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    
    <h3>Участники проекта</h3>
    
    <?= GridView::widget([
        'dataProvider' => $userDataProvider,
        'columns' => [
            [
                'class' => SerialColumn::class,
                'header' => '№',
            ],
            [
                'label' => 'User',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->user->username), Url::to(['user/view', 'id' => $model->user->id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Role',
                'value' => 'role',
            ],
        ],
    ]) ?>
    
    <h3>Задачи в проекте:</h3>
    
    <?= GridView::widget([
        'dataProvider' => $taskDataProvider,
        'columns' => [
            [
                'class' => SerialColumn::class,
                'header' => '№',
            ],
            [
                'label' => 'Task',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->title), Url::to(['task/view', 'id' => $model->task_id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Executor',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->executor->username), Url::to(['user/view', 'id' => $model->executor->id]));
                },
                'format' => 'raw',
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'label' => 'Creator',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->creator->username), Url::to(['user/view', 'id' => $model->creator->id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Updater',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->updater->username), Url::to(['user/view', 'id' => $model->updater->id]));
                },
                'format' => 'raw',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    
    <?php echo \yii2mod\comments\widgets\Comment::widget([
    // https://github.com/yii2mod/yii2-comments
        'model' => $model,
        'entityIdAttribute' => 'project_id',
    ]); ?>

</div>
