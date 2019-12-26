<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Users';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
           <?= Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW)) ?>
        </div>
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email:email',
                    //'status',
                    [
                        'label' => 'Status',
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return \common\models\User::STATUS_LABELS[$model->status];
                        }
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>

</div>
