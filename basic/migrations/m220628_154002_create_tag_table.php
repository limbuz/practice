<?php

use yii\db\Schema;
use yii\db\Migration;

class m220628_154002_create_tag_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('tag', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'frequency' => Schema::TYPE_INTEGER
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tag');
    }
}