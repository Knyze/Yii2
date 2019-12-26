<?php

namespace common\models\query;


use common\models\ProjectUser;
use common\models\Project;

/**
 * This is the ActiveQuery class for [[\common\models\Project]].
 *
 * @see \common\models\Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    public function byUser($userId, $role = null)
    {
        $query = ProjectUser::find()->select('project_id')->byUser($userId, $role);
        
        return $this->andWhere(['project_id' => $query]);
    }
    
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Project[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Project|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function onlyActive()
    {
        return $this->select('title')->andWhere(['active' => Project::STATUS_ACTIVE])->indexBy('project_id')->column();
    }
}
