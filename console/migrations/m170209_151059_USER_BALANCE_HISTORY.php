<?php

use yii\db\Migration;

class m170209_151059_USER_BALANCE_HISTORY extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE `payment_history`(  
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `user_from` INT(11) NOT NULL,
          `user_to` INT(11) NOT NULL,
          `payment` INT(11) NOT NULL,
          `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          FOREIGN KEY (`user_from`) REFERENCES `user`(`id`) ON DELETE CASCADE,
          FOREIGN KEY (`user_to`) REFERENCES `user`(`id`) ON DELETE CASCADE
        ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
        ");
    }

    public function down()
    {
        echo "m170209_151059_USER_BALANCE_HISTORY cannot be reverted.\n";

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
