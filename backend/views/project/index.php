<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['timeout' => 4000, 'enablePushState' => false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'title',
            //'description:ntext',
            [
                'attribute' => 'active',
                'filter' => Project::STATUSES_LABELS,
                'value' => function($model) {
                    return Project::STATUSES_LABELS[$model->active];
                }
            ],
            [
                'label' => 'Creator',
                'attribute' => 'creator_id',
                'filter' => $users,
                'value' => function ($model) {
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
