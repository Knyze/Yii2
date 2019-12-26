<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tasks_tbl".
 *
 * @property int $task_id
 * @property string $title
 * @property string $description
 * @property int|null $project_id
 * @property int|null $executor_id
 * @property int|null $started_at
 * @property int|null $completed_at
 * @property int $creator_id
 * @property int|null $updater_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property User $executor
 * @property User $creator
 * @property User $updater
 */
class Task extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            ['class' => TimestampBehavior::className()],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => 'updater_id',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'project_id'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'title' => 'Title',
            'description' => 'Description',
            'project_id' => 'Project',
            'executor_id' => 'Executor ID',
            'started_at' => 'Started At',
            'completed_at' => 'Completed At',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return \common\models\query\TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaskQuery(get_called_class());
    }
}
