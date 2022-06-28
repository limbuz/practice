<?php

use yii\db\Schema;
use yii\db\Migration;

class m220628_152115_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING,
            'password' => Schema::TYPE_TEXT,
            'salt' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'profile' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user');
    }
}