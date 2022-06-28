<?php

use yii\db\Schema;
use yii\db\Migration;

class m220628_154156_create_lookup_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('lookup', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'code' => Schema::TYPE_INTEGER,
            'type' => Schema::TYPE_STRING,
            'position' => Schema::TYPE_STRING
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('lookup');
    }
}