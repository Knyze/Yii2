<?php

use yii\db\Migration;

/**
 * Class m191125_082532_create_fk_tasks_user
 */
class m191125_082532_create_fk_tasks_user extends Migration
{
    
    public function safeUp()
    {
        $this->addForeignKey('tasks_fk1', 'tasks_tbl', 'executor_id', 'user', 'id', 'NO ACTION');
        $this->addForeignKey('tasks_fk2', 'tasks_tbl', 'creator_id', 'user', 'id', 'NO ACTION');
        $this->addForeignKey('tasks_fk3', 'tasks_tbl', 'updater_id', 'user', 'id', 'NO ACTION');
    }

    public function safeDown()
    {
        $this->dropForeignKey('tasks_fk1', 'tasks_tbl');
        $this->dropForeignKey('tasks_fk2', 'tasks_tbl');
        $this->dropForeignKey('tasks_fk3', 'tasks_tbl');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191125_082532_create_fk_tasks_user cannot be reverted.\n";

        return false;
    }
    */
}
