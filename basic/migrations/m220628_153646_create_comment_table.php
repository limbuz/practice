<?php

use yii\db\Schema;
use yii\db\Migration;

class m220628_153646_create_comment_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => Schema::TYPE_PK,
            'content' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_INTEGER,
            'create_time' => Schema::TYPE_INTEGER,
            'author' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'url' => Schema::TYPE_STRING,
            'post_id' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey('post_id', 'comment', 'post_id', 'post', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('comment');
    }
}