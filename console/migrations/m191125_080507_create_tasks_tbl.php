<?php

use yii\db\Migration;

/**
 * Class m191125_080507_create_tasks_tbl
 */
class m191125_080507_create_tasks_tbl extends Migration
{
    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m191125_080507_create_tasks_tbl cannot be reverted.\n";

        return false;
    }
    */

    public function up()
    {
        $this->createTable('tasks_tbl', [
            'task_id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'project_id' => $this->integer(),
            'executor_id' => $this->integer(),
            'started_at' => $this->integer(),
            'completed_at' => $this->integer(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
        
    }

    public function down()
    {
        $this->dropTable('tasks_tbl');
    }
    
}
