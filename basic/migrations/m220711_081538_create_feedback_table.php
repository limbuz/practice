<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m220711_081538_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'id_city' => $this->integer(),
            'title' => $this->string(100),
            'text' => $this->string(255),
            'rating' => $this->integer(),
            'img' => $this->binary(),
            'id_author' => $this->integer(),
            'date_create' => $this->integer(),
        ]);

        $this->addForeignKey('id_author', '{{%feedback}}', 'id_author', '{{%user}}', 'id');
        $this->addForeignKey('id_city', '{{%feedback}}', 'id_city', '{{%city}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
