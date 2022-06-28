<?php

use yii\db\Schema;
use yii\db\Migration;

class m220628_152517_create_post_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT,
            'tags' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_INTEGER,
            'create_time' => Schema::TYPE_DATE,
            'update_time' => Schema::TYPE_DATE,
            'author_id' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey('author_id', 'post', 'author_id', 'user', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('post');
    }
}