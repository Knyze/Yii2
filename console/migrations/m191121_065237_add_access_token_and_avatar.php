<?php

use yii\db\Migration;

class m191121_065237_add_access_token_and_avatar extends Migration
{

    public function safeUp()
    {
        $this->addColumn('users_tbl', 'access_token', $this->string()->defaultValue(null));
        $this->addColumn('users_tbl', 'avatar', $this->string()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('users_tbl', 'access_token');
        $this->dropColumn('users_tbl', 'avatar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191121_065237_add_access_token_and_avatar cannot be reverted.\n";

        return false;
    }
    */
}
