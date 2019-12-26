<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
           <?= Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW)) ?>
        </div>
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'auth_key',
                    'password_hash',
                    'password_reset_token',
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
                    'verification_token',
                    'access_token',
                    //'avatar',
                ],
            ]) ?>
        </div>
    </div>
    
    <h3>Участие в проектах:</h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            
            [
                'class' => SerialColumn::class,
                'header' => '№',
            ],
            [
                'label' => 'Project',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->project->title), Url::to(['project/view', 'id' => $model->project->project_id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Role',
                'value' => 'role',
            ],
        ],
    ]) ?>
    
    <?php echo \yii2mod\comments\widgets\Comment::widget([
    // https://github.com/yii2mod/yii2-comments
        'model' => $model,
    ]); ?>

</div>
