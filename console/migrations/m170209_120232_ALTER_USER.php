<?php

use yii\db\Migration;

class m170209_120232_ALTER_USER extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `user`   
          CHANGE `auth_key` `auth_key` VARCHAR(32) CHARSET utf8 COLLATE utf8_unicode_ci NULL,
          CHANGE `password_hash` `password_hash` VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NULL,
          CHANGE `email` `email` VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NULL,
          CHANGE `status` `status` SMALLINT(6) DEFAULT 10  NULL,
          CHANGE `created_at` `created_at` INT(11) NULL,
          CHANGE `updated_at` `updated_at` INT(11) NULL;
        ");
    }

    public function down()
    {
        echo "m170209_120232_ALTER_USER cannot be reverted.\n";

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
