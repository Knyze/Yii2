<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ProjectUser]].
 *
 * @see \common\models\ProjectUser
 */
class ProjectUserQuery extends \yii\db\ActiveQuery
{
    public function byUser($userId, $role = null)
    {
        $this->andWhere(['user_id' => $userId]);
        
        if ($role) {
            $this->andWhere(['role' => $role]);
        }
        return $this;
    }
    
    public function byProject($project_id)
    {
        return $this->andWhere(['project_id' => $project_id]);
    }
    
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
