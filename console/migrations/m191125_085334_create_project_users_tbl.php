<?php

use yii\db\Migration;

/**
 * Class m191125_085334_create_project_users_tbl
 */
class m191125_085334_create_project_users_tbl extends Migration
{
    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m191125_085334_create_project_users_tbl cannot be reverted.\n";

        return false;
    }
    */

    public function up()
    {
        $this->createTable('project_users_tbl', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => 'ENUM("manager", "developer", "tester")',
        ]);
        
        $sql = "ALTER TABLE project_users_tbl ALTER role SET DEFAULT 'manager'";
        $this->execute($sql);
        
        $this->addForeignKey('project_users_fk1', 'project_users_tbl', 'project_id', 'projects_tbl', 'project_id', 'NO ACTION');
        $this->addForeignKey('project_users_fk2', 'project_users_tbl', 'user_id', 'users_tbl', 'user_id', 'NO ACTION');
        
    }

    public function down()
    {
        $this->dropForeignKey('project_users_fk1', 'project_users_tbl');
        $this->dropForeignKey('project_users_fk2', 'project_users_tbl');
        
        $this->dropTable('project_users_tbl');
    }
    
}
