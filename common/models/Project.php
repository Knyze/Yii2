<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "projects_tbl".
 *
 * @property int $project_id
 * @property string $title
 * @property string $description
 * @property int $active
 * @property int $creator_id
 * @property int|null $updater_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property ProjectUsers[] $projectUsers
 * @property User $creator
 * @property User $updater
 */
class Project extends \yii\db\ActiveRecord
{
    const RELATION_PROJECT_USERS = 'projectUsers';
    
    const STATUS_NOTACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    const STATUSES = [
        self::STATUS_NOTACTIVE,
        self::STATUS_ACTIVE,
    ];
    
    const STATUSES_LABELS = [
        self::STATUS_NOTACTIVE => 'Неактивен',
        self::STATUS_ACTIVE => 'Активен',
    ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['active'], 'in', 'range' => self::STATUSES],
            [['title'], 'string', 'max' => 255],
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
            'project_id' => 'Project ID',
            'title' => 'Title',
            'description' => 'Description',
            'active' => 'Active',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function behaviors() {
        return [
            ['class' => TimestampBehavior::className()],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => 'updater_id',
            ],
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                //'relationKeyName' => SaveRelationsBehavior::RELATION_KEY_RELATION_NAME,
                'relations' => [
                    self::RELATION_PROJECT_USERS,
                ],
            ],
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUser::className(), ['project_id' => 'project_id']);
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

    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'project_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return \common\models\query\ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProjectQuery(get_called_class());
    }
    
    public function getUserRoles()
    {
        return $this->getProjectUsers()->select('role')->indexBy('user_id')->column();
    }
    
}
