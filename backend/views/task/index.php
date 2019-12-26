<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($canCreate): ?>
    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif ?>

    <?php Pjax::begin(['timeout' => 4000, 'enablePushState' => false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'task_id',
            'title',
            //'description:ntext',
            [
                'label' => 'Project',
                'attribute' => 'project_id',
                'filter' => $projects,
                'value' => function($model) {
                    return Html::a(Html::encode($model->project->title), Url::to(['project/view', 'id' => $model->project->project_id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Executor',
                'attribute' => 'executor_id',
                'filter' => $users,
                'value' => function($model) {
                    return Html::a(Html::encode($model->executor->username), Url::to(['user/view', 'id' => $model->executor->id]));
                },
                'format' => 'raw',
            ],
            //'started_at:datetime',
            [
                'label' => 'Started at',
                'attribute' => 'started_at',
                'format' => ['datetime', 'php:d-m-Y H:i'],
            ],
            [
                'label' => 'Completed at',
                'attribute' => 'completed_at',
                'format' => ['datetime', 'php:d-m-Y H:i'],
            ],
            [
                'label' => 'Creator',
                'attribute' => 'creator_id',
                'filter' => $users,
                'value' => function($model) {
                    return Html::a(Html::encode($model->creator->username), Url::to(['user/view', 'id' => $model->creator->id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Updater',
                'attribute' => 'updater_id',
                'filter' => $users,
                'value' => function($model) {
                    return Html::a(Html::encode($model->updater->username), Url::to(['user/view', 'id' => $model->updater->id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Created at',
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d-m-Y H:i'],
            ],
            [
                'label' => 'Updated at',
                'attribute' => 'updated_at',
                'format' => ['datetime', 'php:d-m-Y H:i'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {complete}',
                'buttons' => [
                    'take' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hourglass');
                        return Html::a($icon, [
                            'task/take',
                            'id' => $model->task_id,
                            ],
                            ['data' =>[
                                 'confirm' => 'Взять задачу?',
                                 'method' => 'post',
                                 'pjax' => 1,
                             ],]);
                    },
                    'complete' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('thumbs-up');
                        return Html::a($icon, [
                            'task/complete',
                            'id' => $model->task_id,
                            ],
                            ['data' =>[
                                'confirm' => 'Завершить задачу?',
                                'method' => 'post',
                                'pjax' => 1,
                            ],]);
                    },
                ],
                'visibleButtons' => [
                    'update' => function(Task $model, $key, $index) {
                        //return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'delete' => function(Task $model, $key, $index) {
                        //return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function(Task $model, $key, $index) {
                        //return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_DEVELOPER);
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                        //return true;
                    },
                    'complete' => function(Task $model, $key, $index) {
                        //return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_DEVELOPER);
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
