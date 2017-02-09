<?php

use yii\db\Migration;

class m170209_124238_ALTER_USER_BALANCE extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `user_balance`   
          CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
        ");
    }

    public function down()
    {
        echo "m170209_124238_ALTER_USER_BALANCE cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
