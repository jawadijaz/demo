<?php

use yii\db\Migration;

class m170209_122322_user_balance extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE `user_balance`(  
          `id` INT(11) NOT NULL,
          `user_id` INT(11) NOT NULL,
          `balance` FLOAT(11) DEFAULT 100,
          PRIMARY KEY (`id`),
          FOREIGN KEY (`user_id`) REFERENCES `demo`.`user`(`id`) ON DELETE CASCADE
        ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
        ");
    }

    public function down()
    {
        echo "m170209_122322_user_balance cannot be reverted.\n";

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
