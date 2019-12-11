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
//die(var_dump($dataProvider));
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_id',
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
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            
            [
                'class' => SerialColumn::class,
                'header' => 'Номер',
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

</div>
