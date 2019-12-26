<?php

namespace common\models\query;


use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\Task]].
 *
 * @see \common\models\Task
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function onlyActive()
    {
        return $this->select('username')->where(['status' => User::STATUS_ACTIVE])->indexBy('id')->column();
    }
    
}
