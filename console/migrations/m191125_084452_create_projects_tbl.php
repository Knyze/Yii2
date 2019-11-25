<?php

use yii\db\Migration;

/**
 * Class m191125_084452_create_projects_tbl
 */
class m191125_084452_create_projects_tbl extends Migration
{
    /*
    public function safeUp()
    {

    }
    
    public function safeDown()
    {
        echo "m191125_084452_create_projects_tbl cannot be reverted.\n";

        return false;
    }
    */

    public function up()
    {
        $this->createTable('projects_tbl', [
            'project_id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
        
        $this->addForeignKey('projects_fk1', 'projects_tbl', 'creator_id', 'user', 'id', 'NO ACTION');
        $this->addForeignKey('projects_fk2', 'projects_tbl', 'updater_id', 'user', 'id', 'NO ACTION');
            
    }

    public function down()
    {
        $this->dropForeignKey('projects_fk1', 'projects_tbl');
        $this->dropForeignKey('projects_fk2', 'projects_tbl');
        
        $this->dropTable('projects_tbl');
    }
}
